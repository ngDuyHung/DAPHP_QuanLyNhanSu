@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sửa nhân viên</h5>
        <small class="text-muted float-end">Cập nhật thông tin nhân viên</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('employees.update', $employee->employee_id) }}">
            @csrf
            @method('PUT')
            <!-- Form fields for employee details -->
            <div class="mb-3">
                <label for="full_name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $employee->full_name }}" required>
            </div>
            <div class="mb-3">  
                <label for="gender" class="form-label">Giới tính</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="M" {{ $employee->gender == 'M' ? 'selected' : '' }}>Nam</option>
                    <option value="F" {{ $employee->gender == 'F' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="dob" name="dob" value="{{ $employee->dob }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $employee->address }}" required>
            </div>
            <div class="mb-3">
                <label for="department_id" class="form-label">Mã phòng ban</label>
                <input type="text" class="form-control" id="department_id" name="department_id" value="{{ $employee->department_id }}">
            </div>
            <div class="mb-3">
                <label for="hire_date" class="form-label">Ngày tuyển dụng</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ $employee->hire_date }}" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Chức vụ</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}" required>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Mã người dùng</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $employee->user_id }}">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>

</div>

@endsection