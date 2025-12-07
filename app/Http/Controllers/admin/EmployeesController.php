<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::all();
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create');
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
        ]);

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
        return view('admin.employees.edit', compact('employee'));
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
        ]);
        $employee->update($validatedData);
        return redirect()->route('employees.index')->with('success', 'Cập nhật nhân viên thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */ 
    public function destroy(String $employees_id)
    {
        $employees = Employees::findOrFail($employees_id);
        $employees->delete();
        return redirect()->route('employees.index')->with('success', 'Xóa nhân viên thành công.');
    }
}
