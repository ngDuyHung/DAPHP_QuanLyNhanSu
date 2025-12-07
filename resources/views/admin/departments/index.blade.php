@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý phòng ban</h4>

                <a class="btn btn-primary" href="{{ route('departments.create') }}">
                    Thêm phòng ban
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã phòng ban</th>
                    <th>Tên phòng ban</th>
                    <th>Trưởng phòng</th>
                    <th>Số lượng nhân viên</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($departments as $department)
                <tr>
                    <td>{{ $department->department_id }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        @if($department->manager)
                        @include('layouts.admin.userInfo', ['employee' => $department->manager])
                        @else
                        <span class="text-muted">Chưa có</span>
                        @endif
                    </td>
                    <td>{{ $department->employees->count() }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('departments.show', $department->department_id) }}" class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                <i class="bx bx-show"></i>
                            </a>
                            <a href="{{ route('departments.edit', $department->department_id) }}" class="btn btn-sm btn-outline-info" title="Sửa">
                                <i class="bx bx-edit"></i>
                            </a>
                            <form action="{{ route('departments.destroy', $department->department_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa phòng ban này không?')">
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