<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $data;
    protected $type;

    public function __construct($data, $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        switch($this->type) {
            case 'employee-by-department':
                return ['Mã NV', 'Họ tên', 'Giới tính', 'Email', 'SĐT', 'Phòng ban', 'Chức vụ', 'Ngày vào'];
            case 'attendance':
                return ['Mã NV', 'Họ tên', 'Ngày', 'Giờ vào', 'Giờ ra', 'Trạng thái'];
            case 'leaves':
                return ['Mã đơn', 'Nhân viên', 'Loại nghỉ', 'Từ ngày', 'Đến ngày', 'Số ngày', 'Trạng thái'];
            case 'salary':
                return ['Mã NV', 'Họ tên', 'Phòng ban', 'Tháng', 'Năm', 'Lương cơ bản', 'Phụ cấp', 'Thưởng', 'Phạt', 'Tổng lương'];
            default:
                return [];
        }
    }

    public function map($row): array
    {
        switch($this->type) {
            case 'employee-by-department':
                return [
                    $row->employee_id,
                    $row->full_name,
                    $row->gender,
                    $row->email,
                    $row->phone,
                    $row->department ? $row->department->name : '',
                    $row->position,
                    $row->hire_date
                ];
            case 'attendance':
                return [
                    $row->employee_id,
                    $row->employee ? $row->employee->full_name : '',
                    date('d/m/Y', strtotime($row->check_in)),
                    date('H:i', strtotime($row->check_in)),
                    $row->check_out ? date('H:i', strtotime($row->check_out)) : 'Chưa checkout',
                    $row->status
                ];
            case 'leaves':
                return [
                    $row->leave_id,
                    $row->employee ? $row->employee->full_name : '',
                    $row->leave_type,
                    date('d/m/Y', strtotime($row->start_date)),
                    date('d/m/Y', strtotime($row->end_date)),
                    \Carbon\Carbon::parse($row->start_date)->diffInDays(\Carbon\Carbon::parse($row->end_date)) + 1,
                    $row->status
                ];
            case 'salary':
                return [
                    $row->employee_id,
                    $row->employee ? $row->employee->full_name : '',
                    $row->employee && $row->employee->department ? $row->employee->department->name : '',
                    $row->month,
                    $row->year,
                    number_format($row->basic_salary),
                    number_format($row->allowance),
                    number_format($row->bonus),
                    number_format($row->deduction),
                    number_format($row->total_salary)
                ];
            default:
                return [];
        }
    }
}
