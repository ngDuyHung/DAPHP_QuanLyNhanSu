<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Rewards_discipline;
use App\Models\Employees;
use Illuminate\Http\Request;

class RewardsDisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rewards = Rewards_discipline::with('employee')->orderBy('date_recorded', 'desc')->get();
        return view('admin.rewards.index', compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::all();
        return view('admin.rewards.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'type' => 'required|string|in:reward,discipline',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'date_recorded' => 'required|date',
        ]);

        Rewards_discipline::create($validatedData);
        return redirect()->route('rewards.index')->with('success', 'Thêm bản ghi thưởng/phạt thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rewards_discipline $rewards_discipline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $record_id)
    {
        $reward = Rewards_discipline::findOrFail($record_id);
        $employees = Employees::all();
        return view('admin.rewards.edit', compact('reward', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $record_id)
    {
        $reward = Rewards_discipline::findOrFail($record_id);
        
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'type' => 'required|string|in:reward,discipline',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric',
            'date_recorded' => 'required|date',
        ]);

        $reward->update($validatedData);
        return redirect()->route('rewards.index')->with('success', 'Cập nhật bản ghi thưởng/phạt thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $record_id)
    {
        $reward = Rewards_discipline::findOrFail($record_id);
        $reward->delete();
        return redirect()->route('rewards.index')->with('success', 'Xóa bản ghi thưởng/phạt thành công.');
    }
}
