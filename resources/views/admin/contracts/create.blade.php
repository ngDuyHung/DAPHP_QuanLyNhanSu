@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thêm hợp đồng</h5>
        <small class="text-muted float-end">Nhập thông tin hợp đồng</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('contracts.store') }}">
            @csrf
            
            <div class="mb-3">
                <label for="employee_id" class="form-label">Nhân viên <span class="text-danger">*</span></label>
                <select class="form-control" id="employee_id" name="employee_id" required>
                    <option value="">-- Chọn nhân viên --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->employee_id }}" {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                            {{ $employee->full_name }} - {{ $employee->position }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="contract_type" class="form-label">Loại hợp đồng <span class="text-danger">*</span></label>
                <select class="form-control" id="contract_type" name="contract_type" required>
                    <option value="">-- Chọn loại hợp đồng --</option>
                    <option value="Hợp đồng thử việc" {{ old('contract_type') == 'Hợp đồng thử việc' ? 'selected' : '' }}>Hợp đồng thử việc</option>
                    <option value="Hợp đồng xác định thời hạn" {{ old('contract_type') == 'Hợp đồng xác định thời hạn' ? 'selected' : '' }}>Hợp đồng xác định thời hạn</option>
                    <option value="Hợp đồng không xác định thời hạn" {{ old('contract_type') == 'Hợp đồng không xác định thời hạn' ? 'selected' : '' }}>Hợp đồng không xác định thời hạn</option>
                    <option value="Hợp đồng thời vụ" {{ old('contract_type') == 'Hợp đồng thời vụ' ? 'selected' : '' }}>Hợp đồng thời vụ</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="start_date" name="start_date" 
                            value="{{ old('start_date') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" 
                            value="{{ old('end_date') }}">
                        <small class="text-muted">Để trống nếu hợp đồng không xác định thời hạn</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="basic_salary" class="form-label">Lương cơ bản <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="basic_salary" name="basic_salary" 
                    value="{{ old('basic_salary') }}" min="0" required>
                <small class="text-muted">Đơn vị: VNĐ</small>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <textarea class="form-control" id="note" name="note" rows="3">{{ old('note') }}</textarea>
                <small class="text-muted">Ghi chú về điều khoản đặc biệt, phúc lợi...</small>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Chưa hiệu lực</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Đang hiệu lực</option>
                    <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Hết hiệu lực</option>
                </select>
            </div>

            <div class="alert alert-info">
                <strong><i class="bx bx-info-circle"></i> Lưu ý về các loại hợp đồng:</strong>
                <ul class="mb-0 mt-2">
                    <li><strong>Hợp đồng thử việc:</strong> Tối đa 60 ngày (2 tháng)</li>
                    <li><strong>Hợp đồng xác định thời hạn:</strong> Từ 12-36 tháng</li>
                    <li><strong>Hợp đồng không xác định thời hạn:</strong> Không có ngày kết thúc</li>
                    <li><strong>Hợp đồng thời vụ:</strong> Dưới 12 tháng cho công việc ngắn hạn</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
