@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sửa tài khoản</h5>
        <small class="text-muted float-end">Cập nhật thông tin tài khoản</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('accounts.update', $account->id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Tên tài khoản <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" 
                    value="{{ old('name', $account->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" 
                    value="{{ old('email', $account->email) }}" required>
                <small class="text-muted">Email sẽ được dùng để đăng nhập</small>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="password" name="password" 
                            placeholder="Để trống nếu không đổi">
                        <small class="text-muted">Chỉ nhập nếu muốn đổi mật khẩu</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                            placeholder="Nhập lại mật khẩu mới">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="employee_id" class="form-label">Liên kết nhân viên</label>
                <select class="form-control" id="employee_id" name="employee_id">
                    <option value="">-- Không liên kết --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->employee_id }}" 
                            {{ old('employee_id', $account->employee ? $account->employee->employee_id : '') == $employee->employee_id ? 'selected' : '' }}>
                            {{ $employee->full_name }} - {{ $employee->position }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Chọn nhân viên để liên kết với tài khoản này</small>
            </div>

            <div class="alert alert-info">
                <strong><i class="bx bx-info-circle"></i> Thông tin tài khoản:</strong><br>
                <ul class="mb-0 mt-2">
                    <li>Trạng thái: 
                        @if($account->email_verified_at)
                            <span class="badge bg-success">Đã xác thực</span>
                        @else
                            <span class="badge bg-secondary">Chưa xác thực</span>
                        @endif
                    </li>
                    <li>Ngày tạo: <strong>{{ $account->created_at ? $account->created_at->format('d/m/Y H:i') : '-' }}</strong></li>
                    <li>Cập nhật lần cuối: <strong>{{ $account->updated_at ? $account->updated_at->format('d/m/Y H:i') : '-' }}</strong></li>
                    @if($account->employee)
                        <li>Đang liên kết với: <strong>{{ $account->employee->full_name }}</strong></li>
                    @else
                        <li>Chưa liên kết với nhân viên nào</li>
                    @endif
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
