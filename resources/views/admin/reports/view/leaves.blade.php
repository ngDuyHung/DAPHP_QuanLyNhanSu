@extends('admin')
@section('content')
<h4 class="fw-bold py-3 mb-4">Báo cáo nghỉ phép</h4>

<div class="card">
    <div class="card-header">
        <h5>Từ {{ date('d/m/Y', strtotime($startDate)) }} đến {{ date('d/m/Y', strtotime($endDate)) }}</h5>
        @if($status)
            <p class="mb-0">Trạng thái: {{ $status }}</p>
        @endif
        <small class="text-muted">Tổng số: {{ $leaves->count() }} đơn nghỉ</small>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
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
                @forelse($leaves as $leave)
                <tr>
                    <td>{{ $leave->leave_id }}</td>
                    <td>{{ $leave->employee ? $leave->employee->full_name : '' }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ date('d/m/Y', strtotime($leave->start_date)) }}</td>
                    <td>{{ date('d/m/Y', strtotime($leave->end_date)) }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}</td>
                    <td>
                        @if($leave->status == 'Approved' || $leave->status == 'Đã duyệt')
                            <span class="badge bg-label-success">Đã duyệt</span>
                        @elseif($leave->status == 'Rejected' || $leave->status == 'Từ chối')
                            <span class="badge bg-label-danger">Từ chối</span>
                        @else
                            <span class="badge bg-label-warning">Chờ duyệt</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
