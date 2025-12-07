@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý nghỉ phép</h4>

                <a class="btn btn-primary" href="{{ route('leaves.create') }}">
                    Thêm đơn nghỉ phép
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Nhân viên</th>
                    <th>Loại nghỉ phép</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Số ngày</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($leaves as $leave)
                <tr>
                    <td>{{ $leave->leave_id }}</td>
                    <td>
                        @if($leave->employee)
                            <strong>{{ $leave->employee->full_name }}</strong><br>
                            <small class="text-muted">{{ $leave->employee->position }}</small>
                        @else
                            <span class="text-muted">Không xác định</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $leaveTypeColors = [
                                'Nghỉ phép năm' => 'info',
                                'Nghỉ ốm' => 'warning',
                                'Nghỉ không lương' => 'secondary',
                                'Nghỉ thai sản' => 'success',
                                'Nghỉ hiếu' => 'dark',
                                'Nghỉ cưới' => 'primary',
                                'Khác' => 'light',
                            ];
                            $badgeColor = $leaveTypeColors[$leave->leave_type] ?? 'info';
                        @endphp
                        <span class="badge bg-{{ $badgeColor }}">{{ $leave->leave_type }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $startDate = \Carbon\Carbon::parse($leave->start_date);
                            $endDate = \Carbon\Carbon::parse($leave->end_date);
                            $days = $startDate->diffInDays($endDate) + 1;
                        @endphp
                        <span class="badge bg-light text-dark">{{ $days }} ngày</span>
                    </td>
                    <td>
                        @if($leave->status == 'pending')
                            <span class="badge bg-warning">Chờ duyệt</span>
                        @elseif($leave->status == 'approved')
                            <span class="badge bg-success">Đã duyệt</span>
                        @elseif($leave->status == 'rejected')
                            <span class="badge bg-danger">Từ chối</span>
                        @else
                            <span class="badge bg-secondary">{{ $leave->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('leaves.edit', $leave->leave_id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('leaves.destroy', $leave->leave_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa đơn nghỉ phép này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection
