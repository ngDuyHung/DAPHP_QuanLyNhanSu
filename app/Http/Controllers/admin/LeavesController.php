<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Leaves;
use App\Models\Employees;
use Illuminate\Http\Request;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaves = Leaves::with('employee')->orderBy('start_date', 'desc')->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::all();
        return view('admin.leaves.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        Leaves::create($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Thêm đơn nghỉ phép thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leaves $leaves)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $leave_id)
    {
        $leave = Leaves::findOrFail($leave_id);
        $employees = Employees::all();
        return view('admin.leaves.edit', compact('leave', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $leave_id)
    {
        $leave = Leaves::findOrFail($leave_id);
        
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'leave_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:pending,approved,rejected',
        ]);

        $leave->update($validatedData);
        return redirect()->route('leaves.index')->with('success', 'Cập nhật đơn nghỉ phép thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $leave_id)
    {
        $leave = Leaves::findOrFail($leave_id);
        $leave->delete();
        return redirect()->route('leaves.index')->with('success', 'Xóa đơn nghỉ phép thành công.');
    }
}
