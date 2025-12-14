<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Báo cáo nghỉ phép</title>
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
    <h2>BÁO CÁO NGHỈ PHÉP</h2>
    <div class="info">
        <p><strong>Từ {{ date('d/m/Y', strtotime($startDate)) }} đến {{ date('d/m/Y', strtotime($endDate)) }}</strong></p>
        @if($status)
            <p>Trạng thái: {{ $status }}</p>
        @endif
        <p>Tổng số: {{ $leaves->count() }} đơn nghỉ</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Nhân viên</th>
                <th>Loại nghỉ</th>
                <th>Từ ngày</th>
                <th>Đến ngày</th>
                <th>Số ngày</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaves as $leave)
            <tr>
                <td>{{ $leave->leave_id }}</td>
                <td>{{ $leave->employee ? $leave->employee->full_name : '' }}</td>
                <td>{{ $leave->leave_type }}</td>
                <td>{{ date('d/m/Y', strtotime($leave->start_date)) }}</td>
                <td>{{ date('d/m/Y', strtotime($leave->end_date)) }}</td>
                <td>{{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}</td>
                <td>{{ $leave->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
