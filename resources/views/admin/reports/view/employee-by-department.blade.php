@extends('admin')
@section('content')
<h4 class="fw-bold py-3 mb-4">Báo cáo nhân sự theo phòng ban</h4>

<div class="card">
    <div class="card-header">
        <h5>{{ $department ? 'Phòng ban: ' . $department->name : 'Tất cả phòng ban' }}</h5>
        <small class="text-muted">Tổng số: {{ $employees->count() }} nhân viên</small>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã NV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Phòng ban</th>
                    <th>Chức vụ</th>
                    <th>Ngày vào</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                <tr>
                    <td>{{ $emp->employee_id }}</td>
                    <td>{{ $emp->full_name }}</td>
                    <td>{{ $emp->gender }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>{{ $emp->phone }}</td>
                    <td>{{ $emp->department ? $emp->department->name : '' }}</td>
                    <td>{{ $emp->position }}</td>
                    <td>{{ date('d/m/Y', strtotime($emp->hire_date)) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
