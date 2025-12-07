<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Employees;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Departments::all();
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::all();
        return view('admin.departments.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'integer|nullable',
        ]);
        if(!empty($validatedData['manager_id'])){
            $manager = Employees::find($validatedData['manager_id']);
            if (!$manager) {
                return redirect()->back()->withErrors(['manager_id' => 'Mã quản lý không tồn tại.'])->withInput();
            }
        }
        Departments::create($validatedData);
        return redirect()->route('departments.index')->with('success', 'Thêm phòng ban thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departments $departments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $department_id)
    {
        $department = Departments::findOrFail($department_id);
        $employees = Employees::all();
        return view('admin.departments.edit', compact('department', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departments $department)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'manager_id' => 'integer|nullable',
        ]);
        
        if(!empty($validatedData['manager_id'])){
            $manager = Employees::find($validatedData['manager_id']);
            if (!$manager) {
                return redirect()->back()->withErrors(['manager_id' => 'Mã quản lý không tồn tại.'])->withInput();
            }
        }
        
        $department->update($validatedData);
        return redirect()->route('departments.index')->with('success', 'Cập nhật phòng ban thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $department_id)
    {
        $department = Departments::findOrFail($department_id);
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Xóa phòng ban thành công.');
    }
}
