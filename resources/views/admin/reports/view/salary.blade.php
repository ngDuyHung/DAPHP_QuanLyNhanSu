@extends('admin')
@section('content')
<h4 class="fw-bold py-3 mb-4">Báo cáo bảng lương</h4>

<div class="card">
    <div class="card-header">
        <h5>Tháng {{ $month }}/{{ $year }}</h5>
        @if($department)
            <p class="mb-0">Phòng ban: {{ $department->name }}</p>
        @endif
        <small class="text-muted">Tổng số: {{ $salaries->count() }} bản lương</small>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Họ tên</th>
                    <th>Phòng ban</th>
                    <th>Lương cơ bản</th>
                    <th>Phụ cấp</th>
                    <th>Thưởng</th>
                    <th>Phạt</th>
                    <th>Tổng lương</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salaries as $salary)
                <tr>
                    <td>{{ $salary->employee_id }}</td>
                    <td>{{ $salary->employee ? $salary->employee->full_name : '' }}</td>
                    <td>{{ $salary->employee && $salary->employee->department ? $salary->employee->department->name : '' }}</td>
                    <td>{{ number_format($salary->basic_salary) }} VNĐ</td>
                    <td>{{ number_format($salary->allowance) }} VNĐ</td>
                    <td class="text-success">{{ number_format($salary->bonus) }} VNĐ</td>
                    <td class="text-danger">{{ number_format($salary->deduction) }} VNĐ</td>
                    <td><strong>{{ number_format($salary->total_salary) }} VNĐ</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Không có dữ liệu</td>
                </tr>
                @endforelse
                @if($salaries->count() > 0)
                <tr class="table-primary">
                    <td colspan="7" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td><strong>{{ number_format($salaries->sum('total_salary')) }} VNĐ</strong></td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
