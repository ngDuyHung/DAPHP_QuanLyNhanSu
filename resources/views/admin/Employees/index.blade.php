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
</div>
<!--/ Basic Bootstrap Table -->


@endsection