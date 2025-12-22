<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Contracts;
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
        $employee = Employees::Where('user_id', Auth::id())->first();

        $date = Carbon::now()->toDateString();   // "2025-12-08"
        $time = Carbon::now()->toTimeString();   // "13:45:10"

        if (!$employee) {
            return redirect()->back()->with('error', 'Không tìm thấy nhân viên liên kết với tài khoản của bạn.');
        }

        //chưa có phòng ban không thể chấm công
        if (!$employee->department_id) {
            return redirect()->back()->with('error', 'Bạn chưa được phân công phòng ban, không thể chấm công!');
        }

        $latestContract = $employee->contracts()->latest('start_date')->first();
        if (!$latestContract) {
            return redirect()->back()->with('error', 'Bạn chưa có hợp đồng lao động, không thể chấm công!');
        }
        if ($latestContract->status !== 'active') {
            return redirect()->back()->with('error', 'Hợp đồng lao động của bạn không ở trạng thái hiệu lực, không thể chấm công!');
        }

        $attendance = Attendance::where('employee_id', $employee->employee_id)->where('date', $date)->first();
        if ($attendance) {
            return redirect()->back()->with('error', 'Bạn đã điểm danh hôm nay vào lúc ' . $attendance->check_in . ' .');
        }
        Attendance::create([
            'employee_id' => $employee->employee_id,
            'date' => $date,
            'check_in' => $time,
        ]);
        return redirect()->back()->with('success', 'Điểm danh thành công vào lúc ' . $time . ' ngày ' . $date);
    }


    public function checkOut(Request $request)
    {
        $employee = Employees::Where('user_id', Auth::id())->first();
        $date = Carbon::now()->toDateString();   // "2025-12-08"
        $time = Carbon::now()->toTimeString();   // "13:45:10"

        $attendance = Attendance::where('employee_id', $employee->employee_id)
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
