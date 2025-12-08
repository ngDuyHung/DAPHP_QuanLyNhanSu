<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employees;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Check-in attendance.
     */
    public function checkIn(Request $request)
    {
        $employeeId =Employees::Where('user_id',Auth::id())->value('employee_id');  
        $date = Carbon::now()->toDateString();   // "2025-12-08"
        $time = Carbon::now()->toTimeString();   // "13:45:10"

        $attendance = Attendance::where('employee_id', $employeeId)->where('date', $date)->first();
        if ($attendance) {
            return redirect()->back()->with('error', 'Bạn đã điểm danh hôm nay vào lúc ' . $attendance->check_in . ' .');
        }
        Attendance::create([
            'employee_id' => $employeeId,
            'date' => $date,
            'check_in' => $time,
        ]);
        return redirect()->back()->with('success', 'Điểm danh thành công vào lúc ' . $time . ' ngày ' . $date);
    }


    public function checkOut(Request $request)
    {
        $employeeId =Employees::Where('user_id',Auth::id())->value('employee_id');  
        $date = Carbon::now()->toDateString();   // "2025-12-08"
        $time = Carbon::now()->toTimeString();   // "13:45:10"

        $attendance = Attendance::where('employee_id', $employeeId)
            ->where('date', $date)
            ->first();

        if (!$attendance) {
            return redirect()->back()->with('error', 'Bạn chưa điểm danh vào hôm nay.');
        }

        if ($attendance->check_out) {
            return redirect()->back()->with('error', 'Bạn đã điểm danh ra hôm nay vào lúc ' . $attendance->check_out . '.');
        }

        $attendance->check_out = $time;
        $attendance->save();

        return redirect()->back()->with('success', 'Điểm danh ra thành công vào lúc ' . $time . ' ngày ' . $date);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
