<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Báo cáo chấm công</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 5px; }
        .info { text-align: center; margin-bottom: 20px; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>
<body>
    <h2>BÁO CÁO CHẤM CÔNG</h2>
    <div class="info">
        <p><strong>Tháng: {{ date('m/Y', strtotime($month)) }}</strong></p>
        @if($employee)
            <p>Nhân viên: {{ $employee->full_name }}</p>
        @endif
        <p>Tổng số: {{ $attendances->count() }} bản ghi</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Họ tên</th>
                <th>Ngày</th>
                <th>Giờ vào</th>
                <th>Giờ ra</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $att)
            <tr>
                <td>{{ $att->employee_id }}</td>
                <td>{{ $att->employee ? $att->employee->full_name : '' }}</td>
                <td>{{ date('d/m/Y', strtotime($att->check_in)) }}</td>
                <td>{{ date('H:i', strtotime($att->check_in)) }}</td>
                <td>{{ $att->check_out ? date('H:i', strtotime($att->check_out)) : 'Chưa checkout' }}</td>
                <td>{{ $att->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
