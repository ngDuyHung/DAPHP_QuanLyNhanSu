@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sửa đơn nghỉ phép</h5>
        <small class="text-muted float-end">Cập nhật thông tin đơn nghỉ phép</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('leaves.update', $leave->leave_id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="employee_id" class="form-label">Nhân viên <span class="text-danger">*</span></label>
                <select class="form-control" id="employee_id" name="employee_id" required>
                    <option value="">-- Chọn nhân viên --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->employee_id }}" 
                            {{ old('employee_id', $leave->employee_id) == $employee->employee_id ? 'selected' : '' }}>
                            {{ $employee->full_name }} - {{ $employee->position }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="leave_type" class="form-label">Loại nghỉ phép <span class="text-danger">*</span></label>
                <select class="form-control" id="leave_type" name="leave_type" required>
                    <option value="">-- Chọn loại nghỉ phép --</option>
                    <option value="Nghỉ phép năm" {{ old('leave_type', $leave->leave_type) == 'Nghỉ phép năm' ? 'selected' : '' }}>Nghỉ phép năm</option>
                    <option value="Nghỉ ốm" {{ old('leave_type', $leave->leave_type) == 'Nghỉ ốm' ? 'selected' : '' }}>Nghỉ ốm</option>
                    <option value="Nghỉ không lương" {{ old('leave_type', $leave->leave_type) == 'Nghỉ không lương' ? 'selected' : '' }}>Nghỉ không lương</option>
                    <option value="Nghỉ thai sản" {{ old('leave_type', $leave->leave_type) == 'Nghỉ thai sản' ? 'selected' : '' }}>Nghỉ thai sản</option>
                    <option value="Nghỉ hiếu" {{ old('leave_type', $leave->leave_type) == 'Nghỉ hiếu' ? 'selected' : '' }}>Nghỉ hiếu</option>
                    <option value="Nghỉ cưới" {{ old('leave_type', $leave->leave_type) == 'Nghỉ cưới' ? 'selected' : '' }}>Nghỉ cưới</option>
                    <option value="Khác" {{ old('leave_type', $leave->leave_type) == 'Khác' ? 'selected' : '' }}>Khác</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                            value="{{ old('start_date', $leave->start_date) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                            value="{{ old('end_date', $leave->end_date) }}" required>
                        <small class="text-muted">Ngày kết thúc phải sau hoặc bằng ngày bắt đầu</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" {{ old('status', $leave->status) == 'pending' ? 'selected' : '' }}>Chờ duyệt</option>
                    <option value="approved" {{ old('status', $leave->status) == 'approved' ? 'selected' : '' }}>Đã duyệt</option>
                    <option value="rejected" {{ old('status', $leave->status) == 'rejected' ? 'selected' : '' }}>Từ chối</option>
                </select>
            </div>

            <div class="alert alert-info">
                @php
                    $startDate = \Carbon\Carbon::parse($leave->start_date);
                    $endDate = \Carbon\Carbon::parse($leave->end_date);
                    $days = $startDate->diffInDays($endDate) + 1;
                @endphp
                <strong><i class="bx bx-calendar"></i> Thông tin nghỉ phép:</strong><br>
                <ul class="mb-0 mt-2">
                    <li>Số ngày nghỉ hiện tại: <strong>{{ $days }} ngày</strong></li>
                    <li>Trạng thái hiện tại: 
                        @if($leave->status == 'pending')
                            <span class="badge bg-warning">Chờ duyệt</span>
                        @elseif($leave->status == 'approved')
                            <span class="badge bg-success">Đã duyệt</span>
                        @else
                            <span class="badge bg-danger">Từ chối</span>
                        @endif
                    </li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
