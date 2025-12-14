<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Báo cáo bảng lương</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 5px; }
        .info { text-align: center; margin-bottom: 20px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
        .total { background-color: #e3f2fd; font-weight: bold; }
    </style>
</head>
<body>
    <h2>BÁO CÁO BẢNG LƯƠNG</h2>
    <div class="info">
        <p><strong>Tháng {{ $month }}/{{ $year }}</strong></p>
        @if($department)
            <p>Phòng ban: {{ $department->name }}</p>
        @endif
        <p>Tổng số: {{ $salaries->count() }} bản lương</p>
    </div>

    <table>
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
            @foreach($salaries as $salary)
            <tr>
                <td>{{ $salary->employee_id }}</td>
                <td>{{ $salary->employee ? $salary->employee->full_name : '' }}</td>
                <td>{{ $salary->employee && $salary->employee->department ? $salary->employee->department->name : '' }}</td>
                <td>{{ number_format($salary->basic_salary) }}</td>
                <td>{{ number_format($salary->allowance) }}</td>
                <td>{{ number_format($salary->bonus) }}</td>
                <td>{{ number_format($salary->deduction) }}</td>
                <td>{{ number_format($salary->total_salary) }}</td>
            </tr>
            @endforeach
            @if($salaries->count() > 0)
            <tr class="total">
                <td colspan="7" style="text-align: right;"><strong>Tổng cộng:</strong></td>
                <td><strong>{{ number_format($salaries->sum('total_salary')) }}</strong></td>
            </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
