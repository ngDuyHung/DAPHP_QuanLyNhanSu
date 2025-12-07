@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý lương</h4>

                <a class="btn btn-primary" href="{{ route('salary.create') }}">
                    Thêm bảng lương
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã lương</th>
                    <th>Nhân viên</th>
                    <th>Tháng/Năm</th>
                    <th>Ngày công</th>
                    <th>Lương cơ bản</th>
                    <th>Phụ cấp</th>
                    <th>Thưởng</th>
                    <th>Khấu trừ</th>
                    <th>Tổng lương</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($salaries as $salary)
                <tr>
                    <td>{{ $salary->salary_id }}</td>
                    <td>
                        @if($salary->employee)
                           @include('layouts.admin.userInfo', ['employee' => $salary->employee])
                        @else
                            <span class="text-muted">Không xác định</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-info">{{ $salary->month }}/{{ $salary->year }}</span>
                    </td>
                    <td>{{ $salary->work_day }} ngày</td>
                    <td class="text-end">{{ number_format($salary->basic_salary, 0, ',', '.') }} đ</td>
                    <td class="text-end">
                        @if($salary->allowance)
                            <span class="text-success">+{{ number_format($salary->allowance, 0, ',', '.') }} đ</span>
                        @else
                            <span class="text-muted">0 đ</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($salary->bonus)
                            <span class="text-success">+{{ number_format($salary->bonus, 0, ',', '.') }} đ</span>
                        @else
                            <span class="text-muted">0 đ</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($salary->deduction)
                            <span class="text-danger">-{{ number_format($salary->deduction, 0, ',', '.') }} đ</span>
                        @else
                            <span class="text-muted">0 đ</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <strong class="text-primary">{{ number_format($salary->total_salary, 0, ',', '.') }} đ</strong>
                    </td>
                    <td>
                        <a href="{{ route('salary.edit', $salary->salary_id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('salary.destroy', $salary->salary_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bảng lương này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection
