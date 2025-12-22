@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý nhân viên</h4>

                <a class="btn btn-primary" href="{{ route('employees.create') }}">
                    Thêm nhân viên
                </a>
            </div>
        </div>
    </div>
    <!-- Form tìm kiếm -->
    <div class="card-header">
        <form method="GET" action="{{ route('employees.index') }}" class="row g-3">
            <!-- Tìm kiếm theo tên, email, điện thoại -->
            <div class="col-md-3">
                <label class="form-label mb-1 small">Tên/Email/Điện thoại</label>
                <input type="text" name="search" class="form-control" placeholder="Nhập từ khóa tìm kiếm..." value="{{ request('search') }}">
            </div>
            
            <!-- Mã nhân viên -->
            <div class="col-md-2">
                <label class="form-label mb-1 small">Mã nhân viên</label>
                <input type="text" name="employee_id" class="form-control" placeholder="Mã NV" value="{{ request('employee_id') }}">
            </div>

            <!-- Phòng ban -->
            <div class="col-md-2">
                <label class="form-label mb-1 small">Phòng ban</label>
                <select name="department" class="form-select">
                    <option value="">-- Tất cả --</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ request('department') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Giới tính -->
            <div class="col-md-2">
                <label class="form-label mb-1 small">Giới tính</label>
                <select name="gender" class="form-select">
                    <option value="">-- Tất cả --</option>
                    <option value="M" {{ request('gender') == 'M' ? 'selected' : '' }}>Nam</option>
                    <option value="F" {{ request('gender') == 'F' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>

            <!-- Vị trí -->
            <div class="col-md-3">
                <label class="form-label mb-1 small">Vị trí</label>
                <input type="text" name="position" class="form-control" placeholder="Nhập vị trí..." value="{{ request('position') }}">
            </div>

            <!-- Ngày vào làm từ -->
            <div class="col-md-2">
                <label class="form-label mb-1 small">Ngày vào từ</label>
                <input type="date" name="hire_date_from" class="form-control" value="{{ request('hire_date_from') }}">
            </div>

            <!-- Ngày vào làm đến -->
            <div class="col-md-2">
                <label class="form-label mb-1 small">Ngày vào đến</label>
                <input type="date" name="hire_date_to" class="form-control" value="{{ request('hire_date_to') }}">
            </div>

            <!-- Buttons -->
            <div class="col-md-8 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-search-alt"></i> Tìm kiếm
                </button>
                <a href="{{ route('employees.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-reset"></i> Xóa bộ lọc
                </a>
            </div>
        </form>
    </div>
    <!-- / Form tìm kiếm -->
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <!-- //employee_id	full_name	gender	dob	email	phone	address	department_id	hire_date	position	user_id	 -->
                    <th>Mã nv</th>
                    <th>Họ tên/email</th>
                    <th>Giới tính</th>
                    <th>Điện thoại</th>
                    <th>Phòng ban</th>
                    <th>Vị trí</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->employee_id }}</td>
                    <td>
                        @include('layouts.admin.userInfo', ['employee' => $employee])
                    </td>
                    <td>
                        @if ($employee->gender == 'M')
                        Nam
                        @else
                        Nữ
                        @endif
                    </td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->department->name ?? 'Chưa có phòng ban' }}</td>
                    <td>{{ $employee->position }}</td>

                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('employees.show', $employee->employee_id) }}" class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ route('employees.edit', $employee->employee_id) }}" class="btn btn-sm btn-outline-info" title="Sửa">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="{{ route('employees.destroy', $employee->employee_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">
                                    <i class="bx bx-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="card-footer">
        <div class="d-flex justify-content-center">
            {{ $employees->links() }}
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection