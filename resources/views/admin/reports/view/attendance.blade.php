@extends('admin')
@section('content')
<h4 class="fw-bold py-3 mb-4">Báo cáo chấm công</h4>

<div class="card">
    <div class="card-header">
        <h5>Tháng: {{ date('m/Y', strtotime($month)) }}</h5>
        @if($employee)
            <p class="mb-0">Nhân viên: {{ $employee->full_name }}</p>
        @endif
        <small class="text-muted">Tổng số: {{ $attendances->count() }} bản ghi</small>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
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
                @forelse($attendances as $att)
                <tr>
                    <td>{{ $att->employee_id }}</td>
                    <td>{{ $att->employee ? $att->employee->full_name : '' }}</td>
                    <td>{{ date('d/m/Y', strtotime($att->check_in)) }}</td>
                    <td>{{ date('H:i', strtotime($att->check_in)) }}</td>
                    <td>{{ $att->check_out ? date('H:i', strtotime($att->check_out)) : 'Chưa checkout' }}</td>
                    <td>
                        @if($att->check_in!= null && $att->check_out != null)
                            <span class="badge bg-label-success">Chấm công đầy đủ</span>
                        @else
                            <span class="badge bg-label-warning">Chấm công thiếu</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
