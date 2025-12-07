@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thêm chấm công</h5>
        <small class="text-muted float-end">Nhập thông tin chấm công</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('attendance.store') }}">
            @csrf
            
            <div class="mb-3">
                <label for="employee_id" class="form-label">Nhân viên <span class="text-danger">*</span></label>
                <select class="form-control" id="employee_id" name="employee_id" required>
                    <option value="">-- Chọn nhân viên --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->employee_id }}" {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                            {{ $employee->full_name }} ({{ $employee->employee_id }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Ngày <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="check_in" class="form-label">Giờ vào <span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="check_in" name="check_in" value="{{ old('check_in') }}" required>
                <small class="text-muted">Giờ làm việc chuẩn: 08:00</small>
            </div>

            <div class="mb-3">
                <label for="check_out" class="form-label">Giờ ra</label>
                <input type="time" class="form-control" id="check_out" name="check_out" value="{{ old('check_out') }}">
                <small class="text-muted">Có thể để trống nếu chưa check-out</small>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('attendance.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
