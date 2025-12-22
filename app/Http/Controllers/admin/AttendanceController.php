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
    public function index(Request $request)
    {
        $query = Attendance::with('employee');

        // Tìm kiếm theo nhân viên
        if ($request->filled('search')) {
            $query->whereHas('employee', function($q) use ($request) {
                $q->where('full_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('employee_id', 'LIKE', "%{$request->search}%");
            });
        }

        // Lọc theo ngày
        if ($request->filled('date_from')) {
            $query->where('date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->where('date', '<=', $request->date_to);
        }

        // Lọc theo trạng thái check-out
        if ($request->filled('status')) {
            if ($request->status == 'complete') {
                $query->whereNotNull('check_out');
            } elseif ($request->status == 'incomplete') {
                $query->whereNull('check_out');
            }
        }

        // Lọc theo nhân viên cụ thể
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $attendances = $query->orderBy('date', 'desc')->paginate(20)->withQueryString();
        $employees = Employees::all();
        
        return view('admin.attendance.index', compact('attendances', 'employees'));
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
