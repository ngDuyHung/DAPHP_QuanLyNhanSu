@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý chấm công</h4>

                <a class="btn btn-primary" href="{{ route('attendance.create') }}">
                    Thêm chấm công
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã chấm công</th>
                    <th>Nhân viên</th>
                    <th>Ngày</th>
                    <th>Giờ vào</th>
                    <th>Giờ ra</th>
                    <th>Số giờ làm việc</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->attendance_id }}</td>
                    <td>
                        @if($attendance->employee)
                            {{ $attendance->employee->full_name }}
                        @else
                            <span class="text-muted">Không xác định</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                    <td>{{ $attendance->check_in }}</td>
                    <td>
                        @if($attendance->check_out)
                            {{ $attendance->check_out }}
                        @else
                            <span class="badge bg-warning">Chưa check-out</span>
                        @endif
                    </td>
                    <td>
                        @if($attendance->check_out)
                            @php
                                $checkIn = \Carbon\Carbon::parse($attendance->date . ' ' . $attendance->check_in);
                                $checkOut = \Carbon\Carbon::parse($attendance->date . ' ' . $attendance->check_out);
                                $hours = $checkIn->diffInHours($checkOut);
                                $minutes = $checkIn->diffInMinutes($checkOut) % 60;
                            @endphp
                            {{ $hours }}h {{ $minutes }}m
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                       
                        @if(@$attendance->check_in !=null && @$attendance->check_out !=null )
                            <span class="badge bg-success">Chấm công đủ</span>
                        @else
                            <span class="badge bg-danger">Thiếu</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('attendance.edit', $attendance->attendance_id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('attendance.destroy', $attendance->attendance_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi chấm công này không?')">Xóa</button>
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
