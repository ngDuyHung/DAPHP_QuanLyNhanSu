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

    <!-- Form tìm kiếm -->
    <div class="card-header pt-2 pb-2">
        <form method="GET" action="{{ route('attendance.index') }}" class="row g-1">
            <div class="col-md-3">
                <label class="form-label mb-1 small">Tên/Mã nhân viên</label>
                <input type="text" name="search" class="form-control" placeholder="Tìm nhân viên..." value="{{ request('search') }}">
            </div>
            
            <div class="col-md-2">
                <label class="form-label mb-1 small">Nhân viên</label>
                <select name="employee_id" class="form-select">
                    <option value="">-- Tất cả --</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->employee_id }}" {{ request('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                        {{ $employee->full_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label mb-1 small">Từ ngày</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>

            <div class="col-md-2">
                <label class="form-label mb-1 small">Đến ngày</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>

            <div class="col-md-1">
                <label class="form-label mb-1 small">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="">-- Tất cả --</option>
                    <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Đầy đủ</option>
                    <option value="incomplete" {{ request('status') == 'incomplete' ? 'selected' : '' }}>Thiếu</option>
                </select>
            </div>

            <div class="col-md-1 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-search-alt"></i> Tìm
                </button>
                <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-reset"></i>
                </a>
            </div>
        </form>
    </div>
    <!-- / Form tìm kiếm -->
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã cc</th>
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
                            @include('layouts.admin.userInfo', ['employee' => $attendance->employee])
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
                        <a href="{{ route('attendance.edit', $attendance->attendance_id) }}" class="btn btn-sm btn-outline-warning"> <i class="bx bx-edit"></i></a>
                        <form action="{{ route('attendance.destroy', $attendance->attendance_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi chấm công này không?')"> <i class="bx bx-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="card-footer">
        <div class="d-flex justify-content-center">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection
