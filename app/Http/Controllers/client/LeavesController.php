<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Leaves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Leaves = Leaves::where('employee_id', Auth::user()->employee->employee_id ?? 0)->get()->sortByDesc('start_date');
        return view('client.leaves', compact('Leaves'));
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
        $validated = $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.after_or_equal' => 'Ngày bắt đầu phải lớn hơn hoặc bằng ngày hôm nay.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
        ]);

        Leaves::create([
            'employee_id' => Auth::user()->employee->employee_id ?? 0,
            'leave_type' => $validated['leave_type'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'status' => 'Pending',
        ]);
        return redirect()->route('client.leaves.index', ['employee_id' => Auth::user()->employee->employee_id ?? 0])->with('success', 'Đơn xin nghỉ phép đã được gửi thành công.');
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
