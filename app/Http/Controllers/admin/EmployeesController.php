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
        ]);
        Employees::create($validatedData);
        return redirect()->route('employees.index')->with('success', 'Thêm nhân viên thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employees $employees)
    {
        //
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
