<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Departments;
use App\Models\Attendance;
use App\Models\Leaves;
use App\Models\Contracts;
use App\Models\Salary;
use App\Models\Rewards_discipline;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('home');
        }
    }

    public function home()
    {
        $employee = Employees::where('user_id', Auth::id())->first();
        return view('client.home', compact('employee'));
    }

    public function dashboard()
    {
        // Thống kê tổng quan
        $totalEmployees = Employees::count();
        $totalDepartments = Departments::count();
        $totalAccounts = User::count();

        // Thống kê hợp đồng
        $activeContracts = Contracts::where('status', 'active')->count();
        $pendingContracts = Contracts::where('status', 'pending')->count();

        // Thống kê nghỉ phép
        $pendingLeaves = Leaves::where('status', 'pending')->count();
        $approvedLeaves = Leaves::where('status', 'approved')
            ->whereMonth('start_date', Carbon::now()->month)
            ->whereYear('start_date', Carbon::now()->year)
            ->count();

        // Thống kê chấm công tháng này
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $attendanceThisMonth = Attendance::whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->count();

        // Thống kê lương tháng này
        $salaryThisMonth = Salary::where('month', $currentMonth)
            ->where('year', $currentYear)
            ->sum('total_salary');

        // Nhân viên mới trong tháng
        $newEmployees = Employees::whereMonth('hire_date', $currentMonth)
            ->whereYear('hire_date', $currentYear)
            ->count();

        // Thưởng/phạt gần đây
        $recentRewards = Rewards_discipline::where('type', 'reward')
            ->whereMonth('date_recorded', $currentMonth)
            ->whereYear('date_recorded', $currentYear)
            ->count();

        $recentDisciplines = Rewards_discipline::where('type', 'discipline')
            ->whereMonth('date_recorded', $currentMonth)
            ->whereYear('date_recorded', $currentYear)
            ->count();

        // Danh sách nhân viên có sinh nhật trong tháng
        $birthdayEmployees = Employees::whereMonth('dob', $currentMonth)
            ->orderByRaw('DAY(dob)')
            ->take(5)
            ->get();

        // Phòng ban có nhiều nhân viên nhất
        $topDepartments = Departments::withCount('employees')
            ->orderBy('employees_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.home', compact(
            'totalEmployees',
            'totalDepartments',
            'totalAccounts',
            'activeContracts',
            'pendingContracts',
            'pendingLeaves',
            'approvedLeaves',
            'attendanceThisMonth',
            'salaryThisMonth',
            'newEmployees',
            'recentRewards',
            'recentDisciplines',
            'birthdayEmployees',
            'topDepartments'
        ));
    }
}
