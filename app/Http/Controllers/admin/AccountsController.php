<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('employee');

        // Tìm kiếm theo tên hoặc email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
            });
        }

        // Lọc theo role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Lọc theo trạng thái liên kết nhân viên
        if ($request->filled('employee_status')) {
            if ($request->employee_status == 'linked') {
                $query->whereNotNull('employee_id');
            } elseif ($request->employee_status == 'unlinked') {
                $query->whereNull('employee_id');
            }
        }

        $accounts = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
        
        return view('admin.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::whereNull('user_id')->get();
        return view('admin.accounts.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|String|max:255',
            'role' => 'required|string|in:admin,hr,employee',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'employee_id' => 'nullable|integer|exists:employees,employee_id|unique:employees,user_id',
        ]);

        // Tạo user
        $user = User::create([
            'name' => $validatedData['name'],
            'role' => $validatedData['role'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Cập nhật user_id cho employee nếu có
        if (!empty($validatedData['employee_id'])) {
            $employee = Employees::find($validatedData['employee_id']);
            $employee->user_id = $user->id;
            $employee->save();
        }

        return redirect()->route('accounts.index')->with('success', 'Thêm tài khoản thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = User::findOrFail($id);
        $employees = Employees::whereNull('user_id')
            ->orWhere('user_id', $id)
            ->get();
        return view('admin.accounts.edit', compact('account', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = User::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,hr,employee',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'employee_id' => 'nullable|integer|exists:employees,employee_id',
        ],[
            'name.required' => 'Tên không được để trống.',
            'role.required' => 'Vai trò không được để trống.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Định dạng email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'employee_id.exists' => 'Mã nhân viên không tồn tại.',
            'employee_id.integer' => 'Mã nhân viên không hợp lệ.',
        ]);

        // Cập nhật thông tin user
        $account->name = $validatedData['name'];
        $account->email = $validatedData['email'];
        
        // Chỉ cập nhật password nếu có nhập
        if (!empty($validatedData['password'])) {
            $account->password = Hash::make($validatedData['password']);
        }
        
        $account->save();

        // Xóa user_id cũ của employee khác
        Employees::where('user_id', $id)->update(['user_id' => null]);

        // Cập nhật user_id cho employee mới
        if (!empty($validatedData['employee_id'])) {
            $employee = Employees::find($validatedData['employee_id']);
            $employee->user_id = $id;
            $employee->save();
        }

        return redirect()->route('accounts.index')->with('success', 'Cập nhật tài khoản thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $account = User::findOrFail($id);
        
        // Xóa liên kết với employee
        Employees::where('user_id', $id)->update(['user_id' => null]);
        
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Xóa tài khoản thành công.');
    }
}
