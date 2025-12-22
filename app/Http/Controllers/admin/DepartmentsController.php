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
    public function index(Request $request)
    {
        $query = Departments::with(['manager', 'employees.contracts']);

        // Tìm kiếm theo tên phòng ban
        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        // Lọc theo trưởng phòng
        if ($request->filled('manager_id')) {
            $query->where('manager_id', $request->manager_id);
        }

        // Lọc theo số lượng nhân viên (min-max)
        if ($request->filled('min_employees') || $request->filled('max_employees')) {
            $allDepts = $query->get();
            
            if ($request->filled('min_employees')) {
                $allDepts = $allDepts->filter(function($dept) use ($request) {
                    return $dept->employees->count() >= $request->min_employees;
                });
            }
            
            if ($request->filled('max_employees')) {
                $allDepts = $allDepts->filter(function($dept) use ($request) {
                    return $dept->employees->count() <= $request->max_employees;
                });
            }
            
            $departments = new \Illuminate\Pagination\LengthAwarePaginator(
                $allDepts->forPage(request('page', 1), 12),
                $allDepts->count(),
                12,
                request('page', 1),
                ['path' => request()->url(), 'query' => request()->query()]
            );
        } else {
            $departments = $query->paginate(12)->withQueryString();
        }

        $managers = Employees::whereNotNull('employee_id')->get();
        
        return view('admin.departments.index', compact('departments', 'managers'));
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
    public function show(String $department_id)
    {
        //nạp quan hệ employees tránh N+1 problem (không phải truy vấn nhiều lần)
        $department = Departments::with(['employees.contracts', 'manager'])->findOrFail($department_id);
        return view('admin.departments.show', compact('department'));
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
        if($department->employees()->count() > 0){
            return redirect()->route('departments.index')->with('error', 'Không thể xóa phòng ban vì còn nhân viên thuộc phòng ban này.');
        }
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Xóa phòng ban thành công.');
    }
}
