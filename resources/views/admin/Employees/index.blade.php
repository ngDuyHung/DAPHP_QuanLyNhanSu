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
                    <th>Mã nhân viên</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Phòng ban</th>
                    <th>Ngày tuyển dụng</th>
                    <th>Vị trí</th>
                    <th>Mã người dùng</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>
                        @if ($employee->gender == 'M')
                        Nam
                        @else
                        Nữ
                        @endif
                    </td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->department_id }}</td>
                    <td>{{ $employee->hire_date }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->user_id }}</td>
                    <td>
                        <a href="{{ route('employees.edit', $employee->employee_id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('employees.destroy', $employee->employee_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')">Xóa</button>
                        </form>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection