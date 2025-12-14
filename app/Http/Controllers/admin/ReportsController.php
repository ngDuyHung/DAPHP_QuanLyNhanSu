<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Departments;
use App\Models\Attendance;
use App\Models\Leaves;
use App\Models\Salary;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Departments::all();
        $employees = Employees::all();
        return view('admin.reports.index', compact('departments', 'employees'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type, Request $request)
    {
        $format = $request->input('format', 'view');
        
        switch($type) {
            case 'employee-by-department':
                return $this->employeeByDepartment($request, $format);
            case 'attendance':
                return $this->attendanceReport($request, $format);
            case 'leaves':
                return $this->leavesReport($request, $format);
            case 'salary':
                return $this->salaryReport($request, $format);
            default:
                return redirect()->route('reports.index');
        }
    }

    private function employeeByDepartment(Request $request, $format)
    {
        $departmentId = $request->input('department_id');
        
        $query = Employees::with('department');
        if($departmentId) {
            $query->where('department_id', $departmentId);
        }
        $employees = $query->get();
        $department = $departmentId ? Departments::find($departmentId) : null;
        
        if($format == 'pdf') {
            $pdf = PDF::loadView('admin.reports.pdf.employee-by-department', compact('employees', 'department'));
            return $pdf->download('bao-cao-nhan-su.pdf');
        } elseif($format == 'excel') {
            return Excel::download(new ReportExport($employees, 'employee-by-department'), 'bao-cao-nhan-su.xlsx');
        }
        
        return view('admin.reports.view.employee-by-department', compact('employees', 'department'));
    }

    private function attendanceReport(Request $request, $format)
    {
        $month = $request->input('month', date('Y-m'));
        $employeeId = $request->input('employee_id');
        
        $query = Attendance::with('employee')
            ->whereYear('check_in', date('Y', strtotime($month)))
            ->whereMonth('check_in', date('m', strtotime($month)));
            
        if($employeeId) {
            $query->where('employee_id', $employeeId);
        }
        
        $attendances = $query->get();
        $employee = $employeeId ? Employees::find($employeeId) : null;
        
        if($format == 'pdf') {
            $pdf = PDF::loadView('admin.reports.pdf.attendance', compact('attendances', 'month', 'employee'));
            return $pdf->download('bao-cao-cham-cong.pdf');
        } elseif($format == 'excel') {
            return Excel::download(new ReportExport($attendances, 'attendance'), 'bao-cao-cham-cong.xlsx');
        }
        
        return view('admin.reports.view.attendance', compact('attendances', 'month', 'employee'));
    }

    private function leavesReport(Request $request, $format)
    {
        $startDate = $request->input('start_date', date('Y-m-01'));
        $endDate = $request->input('end_date', date('Y-m-t'));
        $status = $request->input('status');
        
        $query = Leaves::with('employee')
            ->whereBetween('start_date', [$startDate, $endDate]);
            
        if($status) {
            $query->where('status', $status);
        }
        
        $leaves = $query->get();
        
        if($format == 'pdf') {
            $pdf = PDF::loadView('admin.reports.pdf.leaves', compact('leaves', 'startDate', 'endDate', 'status'));
            return $pdf->download('bao-cao-nghi-phep.pdf');
        } elseif($format == 'excel') {
            return Excel::download(new ReportExport($leaves, 'leaves'), 'bao-cao-nghi-phep.xlsx');
        }
        
        return view('admin.reports.view.leaves', compact('leaves', 'startDate', 'endDate', 'status'));
    }

    private function salaryReport(Request $request, $format)
    {
        $month = $request->input('month', date('n'));
        $year = $request->input('year', date('Y'));
        $departmentId = $request->input('department_id');
        
        $query = Salary::with('employee.department')
            ->where('month', $month)
            ->where('year', $year);
            
        if($departmentId) {
            $query->whereHas('employee', function($q) use ($departmentId) {
                $q->where('department_id', $departmentId);
            });
        }
        
        $salaries = $query->get();
        $department = $departmentId ? Departments::find($departmentId) : null;
        
        if($format == 'pdf') {
            $pdf = PDF::loadView('admin.reports.pdf.salary', compact('salaries', 'month', 'year', 'department'));
            return $pdf->download('bao-cao-luong.pdf');
        } elseif($format == 'excel') {
            return Excel::download(new ReportExport($salaries, 'salary'), 'bao-cao-luong.xlsx');
        }
        
        return view('admin.reports.view.salary', compact('salaries', 'month', 'year', 'department'));
    }
}
