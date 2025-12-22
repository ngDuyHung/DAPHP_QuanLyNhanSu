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
    public function index(Request $request)
    {
        $query = Rewards_discipline::with('employee');

        // Tìm kiếm theo nhân viên
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // Lọc theo loại (thưởng/phạt)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Tìm kiếm theo tiêu đề
        if ($request->filled('title')) {
            $query->where('title', 'LIKE', '%' . $request->title . '%');
        }

        // Lọc theo ngày ghi nhận
        if ($request->filled('date_from')) {
            $query->where('date_recorded', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('date_recorded', '<=', $request->date_to);
        }

        // Lọc theo số tiền
        if ($request->filled('amount_min')) {
            $query->where('amount', '>=', $request->amount_min);
        }
        if ($request->filled('amount_max')) {
            $query->where('amount', '<=', $request->amount_max);
        }

        $rewards = $query->orderBy('date_recorded', 'desc')->paginate(20)->withQueryString();
        $employees = Employees::all();
        
        return view('admin.rewards.index', compact('rewards', 'employees'));
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
