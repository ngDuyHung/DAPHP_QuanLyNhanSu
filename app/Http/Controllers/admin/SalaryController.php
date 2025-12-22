<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Salary;
use App\Models\Employees;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Salary::with('employee');

        // Tìm kiếm theo nhân viên
        if ($request->filled('search')) {
            $query->whereHas('employee', function($q) use ($request) {
                $q->where('full_name', 'LIKE', "%{$request->search}%")
                  ->orWhere('employee_id', 'LIKE', "%{$request->search}%");
            });
        }

        // Lọc theo tháng
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        // Lọc theo năm
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // Lọc theo khoảng lương
        if ($request->filled('min_salary')) {
            $query->where('total_salary', '>=', $request->min_salary);
        }
        
        if ($request->filled('max_salary')) {
            $query->where('total_salary', '<=', $request->max_salary);
        }

        // Lọc theo nhân viên cụ thể
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $salaries = $query->orderBy('year', 'desc')->orderBy('month', 'desc')->paginate(20)->withQueryString();
        $employees = Employees::all();
        
        return view('admin.salary.index', compact('salaries', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employees::all();
        return view('admin.salary.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
            'work_day' => 'required|numeric|min:0|max:31',
            'basic_salary' => 'required|numeric|min:0',
            'allowance' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deduction' => 'nullable|numeric|min:0',
        ]);

        // Tính tổng lương
        $allowance = $validatedData['allowance'] ?? 0;
        $bonus = $validatedData['bonus'] ?? 0;
        $deduction = $validatedData['deduction'] ?? 0;
        
        $validatedData['total_salary'] = $validatedData['basic_salary'] + $allowance + $bonus - $deduction;

        Salary::create($validatedData);
        return redirect()->route('salary.index')->with('success', 'Thêm bảng lương thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $salary_id)
    {
        $salary = Salary::findOrFail($salary_id);
        $employees = Employees::all();
        return view('admin.salary.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        $validatedData = $request->validate([
            'employee_id' => 'required|integer|exists:employees,employee_id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
            'work_day' => 'required|numeric|min:0|max:31',
            'basic_salary' => 'required|numeric|min:0',
            'allowance' => 'nullable|numeric|min:0',
            'bonus' => 'nullable|numeric|min:0',
            'deduction' => 'nullable|numeric|min:0',
        ]);

        // Tính tổng lương
        $allowance = $validatedData['allowance'] ?? 0;
        $bonus = $validatedData['bonus'] ?? 0;
        $deduction = $validatedData['deduction'] ?? 0;
        
        $validatedData['total_salary'] = $validatedData['basic_salary'] + $allowance + $bonus - $deduction;

        $salary->update($validatedData);
        return redirect()->route('salary.index')->with('success', 'Cập nhật bảng lương thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $salary_id)
    {
        $salary = Salary::findOrFail($salary_id);
        $salary->delete();
        return redirect()->route('salary.index')->with('success', 'Xóa bảng lương thành công.');
    }

    public function calculate(Request $request)
{
    $month = $request->month ?? date('m');
    $year = $request->year ?? date('Y');

    // Lấy tất cả nhân viên có hợp đồng đang hiệu lực (active)
    $employees = Employees::whereHas('contracts', function($q) {
        $q->where('status', 'active');
    })->with(['contracts' => function($q) {
        $q->where('status', 'active');
    }])->get();

    $calculatedCount = 0;

    foreach ($employees as $employee) {
        // Kiểm tra xem đã tính lương cho nhân viên này trong tháng này chưa
        $exists = Salary::where('employee_id', $employee->employee_id)
                        ->where('month', $month)
                        ->where('year', $year)
                        ->exists();
        if ($exists) continue;

        // 1. LẤY LƯƠNG CƠ BẢN TỪ HỢP ĐỒNG THỰC TẾ
        $contract = $employee->contracts->first();
        $basicSalary = $contract->basic_salary; // Lấy từ bảng contracts

        // 2. TÍNH NGÀY CÔNG THỰC TẾ TỪ CHẤM CÔNG
        // Đếm số ngày có dữ liệu trong bảng attendance
        $actualWorkDays = \App\Models\Attendance::where('employee_id', $employee->employee_id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();

        // 3. LẤY THƯỞNG/PHẠT THỰC TẾ
        // Tổng tiền thưởng từ bảng rewards_discipline [type = reward]
        $bonus = \App\Models\Rewards_Discipline::where('employee_id', $employee->employee_id)
            ->where('type', 'reward')
            ->whereMonth('date_recorded', $month)
            ->whereYear('date_recorded', $year)
            ->sum('amount');

        // Tổng tiền phạt từ bảng rewards_discipline [type = discipline]
        $deduction = \App\Models\Rewards_Discipline::where('employee_id', $employee->employee_id)
            ->where('type', 'discipline')
            ->whereMonth('date_recorded', $month)
            ->whereYear('date_recorded', $year)
            ->sum('amount');

        // 4. CÔNG THỨC TÍNH LƯƠNG
        // lương cơ bản trong hợp đồng là lương cho một tháng làm đủ.
        //tính như sau: (Lương CB / 26 ngày tiêu chuẩn) * Ngày công thực tế
        $standardDays = 26; 
        $salaryByWorkDays = ($basicSalary / $standardDays) * $actualWorkDays;
        
        $totalSalary = $salaryByWorkDays + $bonus - $deduction;

        // 5. LƯU VÀO BẢNG SALARY
        Salary::create([
            'employee_id'  => $employee->employee_id,
            'month'        => $month,
            'year'         => $year,
            'work_day'     => $actualWorkDays,
            'basic_salary' => $basicSalary,
            'allowance'    => 0, 
            'bonus'        => $bonus,
            'deduction'    => $deduction,
            'total_salary' => $totalSalary
        ]);

        $calculatedCount++;
    }

    return redirect()->route('salary.index')->with('success', "Đã tính lương cho $calculatedCount nhân viên dựa trên dữ liệu thực tế.");
}
}
