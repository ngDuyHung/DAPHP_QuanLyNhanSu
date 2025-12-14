<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Báo cáo nhân sự theo phòng ban</title>
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
    <h2>BÁO CÁO NHÂN SỰ THEO PHÒNG BAN</h2>
    <div class="info">
        <p><strong>{{ $department ? 'Phòng ban: ' . $department->name : 'Tất cả phòng ban' }}</strong></p>
        <p>Tổng số: {{ $employees->count() }} nhân viên</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Phòng ban</th>
                <th>Chức vụ</th>
                <th>Ngày vào</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
            <tr>
                <td>{{ $emp->employee_id }}</td>
                <td>{{ $emp->full_name }}</td>
                <td>{{ $emp->gender }}</td>
                <td>{{ $emp->email }}</td>
                <td>{{ $emp->phone }}</td>
                <td>{{ $emp->department ? $emp->department->name : '' }}</td>
                <td>{{ $emp->position }}</td>
                <td>{{ date('d/m/Y', strtotime($emp->hire_date)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
