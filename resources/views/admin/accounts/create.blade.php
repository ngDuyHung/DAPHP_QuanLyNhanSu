@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thêm tài khoản</h5>
        <small class="text-muted float-end">Tạo tài khoản đăng nhập mới</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('accounts.store') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Tên tài khoản <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name') }}" placeholder="Nhập tên tài khoản" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email') }}" placeholder="example@email.com" required>
                <small class="text-muted">Email sẽ được dùng để đăng nhập</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Nhập mật khẩu" required>
                        <small class="text-muted">Tối thiểu 8 ký tự</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Nhập lại mật khẩu" required>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="employee_id" class="form-label">Liên kết nhân viên</label>
                <select class="form-control" id="employee_id" name="employee_id">
                    <option value="">-- Không liên kết --</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->employee_id }}" {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                        {{ $employee->full_name }} - {{ $employee->position }}
                    </option>
                    @endforeach
                </select>
                <small class="text-muted">Chọn nhân viên để liên kết với tài khoản này (không bắt buộc)</small>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Vai trò <span class="text-danger">*</span></label>
                <select class="form-control" id="role" name="role" required>
                    <option value="">-- Chọn vai trò --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                    <option value="hr" {{ old('role') == 'hr' ? 'selected' : '' }}>Nhân sự</option>
                    <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Nhân viên</option>
                </select>
                <small class="text-muted">Chọn vai trò phù hợp cho tài khoản</small>
            </div>
            <div class="alert alert-info">
                <strong><i class="bx bx-info-circle"></i> Lưu ý:</strong>
                <ul class="mb-0 mt-2">
                    <li>Email phải là duy nhất trong hệ thống</li>
                    <li>Mật khẩu phải có ít nhất 8 ký tự</li>
                    <li>Có thể tạo tài khoản mà không liên kết với nhân viên</li>
                    <li>Mỗi nhân viên chỉ có thể liên kết với 1 tài khoản</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection