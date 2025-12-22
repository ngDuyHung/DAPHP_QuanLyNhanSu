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
        ],[
            'employee_id.exists' => 'Nhân viên không tồn tại trong hệ thống.',
            'employee_id.required' => 'Vui lòng chọn nhân viên.',
            'employee_id.integer' => 'Giá trị không hợp lệ.',
            'start_date.required' => 'Vui lòng nhập ngày bắt đầu hợp đồng.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu.',
            'status.in' => 'Trạng thái hợp đồng không hợp lệ.',
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

    public function renew(Request $request, String $contract_id)
    {
        $validate = $request->validate([
            'end_date' => 'required|date|after:today',
        ],[
            'end_date.required' => 'Vui lòng chọn ngày gia hạn.',
            'end_date.after' => 'Ngày gia hạn phải là ngày trong tương lai.',
        ]);
        $contract = Contracts::findOrFail($contract_id);
        if(!$contract){
            return redirect()->route('contracts.index')->with('error', 'Hợp đồng không tồn tại.');
        }
        if($contract->status != 'active'){
            return redirect()->route('contracts.index')->with('error', 'Chỉ có thể gia hạn hợp đồng đang hoạt động.');
        }
        if($validate['end_date'] <= $contract->end_date){
            return redirect()->route('contracts.index')->with('error', 'Ngày gia hạn phải sau ngày kết thúc hiện tại của hợp đồng.');
        }
        
        $newEndDate =$validate['end_date'];
        $contract->update([
            'end_date' => $newEndDate,
            'status' => 'active',
        ]);
        return redirect()->route('contracts.index')->with('success', 'Gia hạn hợp đồng thành công.');
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
