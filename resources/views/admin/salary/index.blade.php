@extends('admin')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center border-bottom py-3">
        <h4 class="m-0 fw-bold">Quản lý lương</h4>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-dark shadow-sm" data-bs-toggle="modal" data-bs-target="#calcSalaryModal">
                <i class="bx bx-calculator me-1"></i> Tính lương tự động
            </button>
            <a class="btn btn-primary shadow-sm" href="{{ route('salary.create') }}">
                <i class="bx bx-plus me-1"></i> Thêm bảng lương
            </a>
        </div>
    </div>

    <div class="card-body bg-light-subtle border-bottom">
        <form method="GET" action="{{ route('salary.index') }}" class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-semibold small">Tìm kiếm</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Tên hoặc mã NV..." value="{{ request('search') }}">
                </div>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold small">Tháng</label>
                <select name="month" class="form-select">
                    <option value="">-- Tất cả --</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                        @endfor
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold small">Năm</label>
                <select name="year" class="form-select">
                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                    <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold small">Khoảng lương (Triệu đ)</label>
                <div class="input-group">
                    <input type="number" name="min_salary" class="form-control" placeholder="Từ" value="{{ request('min_salary') }}">
                    <input type="number" name="max_salary" class="form-control" placeholder="Đến" value="{{ request('max_salary') }}">
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
                <a href="{{ route('salary.index') }}" class="btn btn-outline-secondary" title="Reset"><i class="bx bx-refresh"></i></a>
            </div>
        </form>
    </div>

    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Mã NV</th>
                    <th>Nhân viên</th>
                    <th>Kỳ lương</th>
                    <th>Công</th>
                    <th class="text-end">Lương CB</th>
                    <th class="text-end text-success">Thưởng/PC</th>
                    <th class="text-end text-danger">Khấu trừ</th>
                    <th class="text-end fw-bold">Thực lĩnh</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salaries as $salary)
                <tr>
                    <td><span class="fw-bold">#{{ $salary->employee->employee_id ?? '---' }}</span></td>
                    <td>
                        @if($salary->employee)
                        @include('layouts.admin.userInfo', ['employee' => $salary->employee])
                        @else
                        <span class="text-muted">Không xác định</span>
                        @endif
                    </td>
                    <td><span class="badge bg-label-info">{{ $salary->month }}/{{ $salary->year }}</span></td>
                    <td><span class="fw-semibold">{{ $salary->work_day }}</span> <small class="text-muted">công</small></td>
                    <td class="text-end text-dark">{{ number_format($salary->basic_salary, 0, ',', '.') }}</td>
                    <td class="text-end text-success">+{{ number_format(($salary->allowance + $salary->bonus), 0, ',', '.') }}</td>
                    <td class="text-end text-danger">-{{ number_format($salary->deduction, 0, ',', '.') }}</td>
                    <td class="text-end"><span class="text-primary fw-bold">{{ number_format($salary->total_salary, 0, ',', '.') }} đ</span></td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class='bx bx-slider-alt'></i> </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('salary.edit', $salary->salary_id) }}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                                <form action="{{ route('salary.destroy', $salary->salary_id) }}" method="POST" onsubmit="return confirm('Xóa bảng lương này?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger"><i class="bx bx-trash me-1"></i> Xóa</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer border-top">{{ $salaries->links() }}</div>
</div>

<div class="modal fade" id="calcSalaryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('salary.calculate') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Cấu hình tính lương tự động</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-warning mb-4">
                    <i class="bx bx-info-circle me-1"></i> Hệ thống sẽ quét dữ liệu <strong>Chấm công</strong> và <strong>Hợp đồng</strong> để tạo bảng lương. Nếu nhân viên đã có lương trong kỳ này, hệ thống sẽ bỏ qua.
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label fw-bold">Chọn Tháng</label>
                        <select name="month" class="form-select">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold">Chọn Năm</label>
                        <select name="year" class="form-select">
                            @for($y = date('Y'); $y >= date('Y') - 2; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light p-3">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                <button type="submit" class="btn btn-dark px-4">Xác nhận tính lương</button>
            </div>
        </form>
    </div>
</div>

<style>
    .bg-label-info {
        background-color: #e1f0ff;
        color: #03c3ec;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(105, 108, 255, 0.03);
    }
</style>

@endsection