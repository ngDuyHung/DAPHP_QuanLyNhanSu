<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employees;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::with('employee')->orderBy('date', 'desc')->get();
        return view('admin.attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::all();
        return view('admin.attendance.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'date' => 'required|date',
            'check_in' => 'required',
            'check_out' => 'nullable',
        ]);

        Attendance::create($validatedData);
        return redirect()->route('attendance.index')->with('success', 'Thêm chấm công thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $attendance_id)
    {
        $attendance = Attendance::findOrFail($attendance_id);
        $employees = Employees::all();
        return view('admin.attendance.edit', compact('attendance', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'date' => 'required|date',
            'check_in' => 'required',
            'check_out' => 'nullable',
        ]);

        $attendance->update($validatedData);
        return redirect()->route('attendance.index')->with('success', 'Cập nhật chấm công thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $attendance_id)
    {
        $attendance = Attendance::findOrFail($attendance_id);
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Xóa chấm công thành công.');
    }
}
