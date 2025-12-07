<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Contracts;
use App\Models\Employees;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contracts::with('employee')->orderBy('start_date', 'desc')->get();
        return view('admin.contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::all();
        return view('admin.contracts.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'contract_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'basic_salary' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'status' => 'required|string|in:pending,active,expired',
        ]);

        Contracts::create($validatedData);
        return redirect()->route('contracts.index')->with('success', 'Thêm hợp đồng thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contracts $contracts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $contract_id)
    {
        $contract = Contracts::findOrFail($contract_id);
        $employees = Employees::all();
        return view('admin.contracts.edit', compact('contract', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $contract_id)
    {
        $contract = Contracts::findOrFail($contract_id);
        
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'contract_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'basic_salary' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'status' => 'required|string|in:pending,active,expired',
        ]);

        $contract->update($validatedData);
        return redirect()->route('contracts.index')->with('success', 'Cập nhật hợp đồng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $contract_id)
    {
        $contract = Contracts::findOrFail($contract_id);
        $contract->delete();
        return redirect()->route('contracts.index')->with('success', 'Xóa hợp đồng thành công.');
    }
}
