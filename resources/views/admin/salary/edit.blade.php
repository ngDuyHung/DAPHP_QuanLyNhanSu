@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sửa bảng lương</h5>
        <small class="text-muted float-end">Cập nhật thông tin bảng lương</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('salary.update', $salary->salary_id) }}">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Nhân viên <span class="text-danger">*</span></label>
                        <select class="form-control" id="employee_id" name="employee_id" required>
                            <option value="">-- Chọn nhân viên --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->employee_id }}" 
                                    {{ old('employee_id', $salary->employee_id) == $employee->employee_id ? 'selected' : '' }}>
                                    {{ $employee->full_name }} - {{ $employee->position }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="month" class="form-label">Tháng <span class="text-danger">*</span></label>
                        <select class="form-control" id="month" name="month" required>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('month', $salary->month) == $i ? 'selected' : '' }}>
                                    Tháng {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="year" class="form-label">Năm <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="year" name="year" 
                            value="{{ old('year', $salary->year) }}" min="2000" max="2100" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="work_day" class="form-label">Số ngày công <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="work_day" name="work_day" 
                            value="{{ old('work_day', $salary->work_day) }}" step="0.5" min="0" max="31" required>
                        <small class="text-muted">Số ngày làm việc trong tháng</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="basic_salary" class="form-label">Lương cơ bản <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="basic_salary" name="basic_salary" 
                            value="{{ old('basic_salary', $salary->basic_salary) }}" min="0" required>
                        <small class="text-muted">Đơn vị: VNĐ</small>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="allowance" class="form-label">Phụ cấp</label>
                        <input type="number" class="form-control" id="allowance" name="allowance" 
                            value="{{ old('allowance', $salary->allowance) }}" min="0">
                        <small class="text-muted">Phụ cấp ăn ca, xăng xe, điện thoại...</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="bonus" class="form-label">Thưởng</label>
                        <input type="number" class="form-control" id="bonus" name="bonus" 
                            value="{{ old('bonus', $salary->bonus) }}" min="0">
                        <small class="text-muted">Thưởng hiệu suất, dự án...</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="deduction" class="form-label">Khấu trừ</label>
                        <input type="number" class="form-control" id="deduction" name="deduction" 
                            value="{{ old('deduction', $salary->deduction) }}" min="0">
                        <small class="text-muted">Bảo hiểm, thuế, phạt...</small>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <strong>Tổng lương hiện tại:</strong> 
                <span class="text-primary fw-bold">{{ number_format($salary->total_salary, 0, ',', '.') }} đ</span><br>
                <small>Tổng lương sẽ được tự động tính lại khi lưu thay đổi</small>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('salary.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
