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

    <!-- Form tìm kiếm -->
    <div class="card-header pt-0 mt-0">
        <form method="GET" action="{{ route('salary.index') }}" class="row g-1">
            <div class="col-md-3">
                <label class="form-label mb-1 small">Tên/Mã nhân viên</label>
                <input type="text" name="search" class="form-control" placeholder="Tìm nhân viên..." value="{{ request('search') }}">
            </div>
            
            <div class="col-md-1">
                <label class="form-label mb-1 small">Nhân viên</label>
                <select name="employee_id" class="form-select">
                    <option value="">-- Tất cả --</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->employee_id }}" {{ request('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                        {{ $employee->full_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-1">
                <label class="form-label mb-1 small">Tháng</label>
                <select name="month" class="form-select">
                    <option value="">-- Tất cả --</option>
                    @for($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label mb-1 small">Năm</label>
                <select name="year" class="form-select">
                    <option value="">-- Tất cả --</option>
                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label mb-1 small">Lương từ</label>
                <input type="number" name="min_salary" class="form-control" placeholder="0" value="{{ request('min_salary') }}" min="0">
            </div>

            <div class="col-md-2">
                <label class="form-label mb-1 small">Lương đến</label>
                <input type="number" name="max_salary" class="form-control" placeholder="100000000" value="{{ request('max_salary') }}" min="0">
            </div>

            <div class="col-md-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bx bx-search-alt"></i> Tìm kiếm
                </button>
                <a href="{{ route('salary.index') }}" class="btn btn-outline-secondary">
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
    
    <!-- Pagination -->
    <div class="card-footer">
        <div class="d-flex justify-content-center">
            {{ $salaries->links() }}
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection
