<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employees::with('department');

        // Tìm kiếm theo tên, email, điện thoại
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        // Tìm kiếm theo mã nhân viên
        if ($request->filled('employee_id')) {
            $query->where('employee_id', 'LIKE', "%{$request->employee_id}%");
        }

        // Lọc theo phòng ban
        if ($request->filled('department')) {
            $query->where('department_id', $request->department);
        }

        // Lọc theo giới tính
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Tìm kiếm theo vị trí
        if ($request->filled('position')) {
            $query->where('position', 'LIKE', "%{$request->position}%");
        }

        // Lọc theo ngày vào làm (từ ngày)
        if ($request->filled('hire_date_from')) {
            $query->where('hire_date', '>=', $request->hire_date_from);
        }

        // Lọc theo ngày vào làm (đến ngày)
        if ($request->filled('hire_date_to')) {
            $query->where('hire_date', '<=', $request->hire_date_to);
        }

        $employees = $query->paginate(15)->withQueryString();
        $departments = \App\Models\Departments::all();
        
        return view('admin.employees.index', compact('employees', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = \App\Models\Departments::all();
        return view('admin.employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'department_id' => 'integer|nullable',
            'hire_date' => 'required|date',
            'position' => 'required|string|max:255',
            'user_id' => 'integer|nullable',
            'auto_createAC' => 'sometimes|boolean',
            'img_link' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'dob.date' => 'Ngày tháng không hợp lệ.',
            'hire_date.date' => 'Ngày tháng không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'auto_createAC.boolean' => 'Giá trị tự động tạo tài khoản không hợp lệ.',
            'img_link.image' => 'Tệp tải lên phải là ảnh.',
            'img_link.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'img_link.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('img_link')) {
            $image = $request->file('img_link');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('employees', $imageName, 'public');
            $validatedData['img_link'] = $imagePath;
        }

        if(!empty($validatedData['department_id'])){
            $department = \App\Models\Departments::find($validatedData['department_id']);
            if (!$department) {
                return redirect()->back()->withErrors(['department_id' => 'Mã phòng ban không tồn tại.'])->withInput();
            }
        }

        if($request->has('auto_createAC')){
            // Tự động tạo tài khoản
            $usernamePart = strstr($validatedData['email'], '@', true); // kết quả: "duyhung" bỏ phần @gmail.com
            $user = \App\Models\User::create([
                'name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($usernamePart), // Mật khẩu mặc định
            ]);
            $validatedData['user_id'] = $user->id;
        }else{
            if(!empty($validatedData['user_id'])){
                $user = \App\Models\User::find($validatedData['user_id']);
                if (!$user) {
                    return redirect()->back()->withErrors(['user_id' => 'Mã người dùng không tồn tại.'])->withInput();
                }
            }
        }
        Employees::create($validatedData);
        return redirect()->route('employees.index')->with('success', 'Thêm nhân viên thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $employee_id)
    {
        $employee = Employees::with(['department', 'contracts', 'attendances', 'leaves', 'rewardsDisciplines', 'salaries', 'user'])->findOrFail($employee_id);
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $employee_id)
    {
        $employee = Employees::findOrFail($employee_id);
        $departments = \App\Models\Departments::all();
        return view('admin.employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employees $employee)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'dob' => 'required|date',
            'email' => 'required|email|unique:employees,email,' . $employee->employee_id . ',employee_id',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'department_id' => 'integer|nullable',
            'hire_date' => 'required|date',
            'position' => 'required|string|max:255',
            'user_id' => 'integer|nullable',
            'img_link' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'dob.date' => 'Ngày tháng không hợp lệ.',
            'hire_date.date' => 'Ngày tháng không hợp lệ.',
            'email.unique' => 'Email đã tồn tại trong hệ thống.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'img_link.image' => 'Tệp tải lên phải là ảnh.',
            'img_link.mimes' => 'Ảnh phải có định dạng: jpeg, png, jpg, gif.',
            'img_link.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);

        // Xử lý upload ảnh mới
        if ($request->hasFile('img_link')) {
            // Xóa ảnh cũ nếu có
            if ($employee->img_link && Storage::disk('public')->exists($employee->img_link)) {
                Storage::disk('public')->delete($employee->img_link);
            }
            
            // Lưu ảnh mới
            $image = $request->file('img_link');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('employees', $imageName, 'public');
            $validatedData['img_link'] = $imagePath;
        }

        $employee->update($validatedData);
        return redirect()->route('employees.index')->with('success', 'Cập nhật nhân viên thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */ 
    public function destroy(String $employees_id)
    {
        $employees = Employees::findOrFail($employees_id);
        
        // Xóa ảnh nếu có
        if ($employees->img_link && Storage::disk('public')->exists($employees->img_link)) {
            Storage::disk('public')->delete($employees->img_link);
        }
        
        $employees->delete();
        return redirect()->route('employees.index')->with('success', 'Xóa nhân viên thành công.');
    }
}
