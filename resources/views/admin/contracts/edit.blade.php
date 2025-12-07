@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sửa hợp đồng</h5>
        <small class="text-muted float-end">Cập nhật thông tin hợp đồng</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('contracts.update', $contract->contract_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="employee_id" class="form-label">Nhân viên <span class="text-danger">*</span></label>
                <select class="form-control" id="employee_id" name="employee_id" required>
                    <option value="">-- Chọn nhân viên --</option>
                    @foreach($employees as $employee)
                    <option value="{{ $employee->employee_id }}"
                        {{ old('employee_id', $contract->employee_id) == $employee->employee_id ? 'selected' : '' }}>
                        {{ $employee->full_name }} - {{ $employee->position }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="contract_type" class="form-label">Loại hợp đồng <span class="text-danger">*</span></label>
                <select class="form-control" id="contract_type" name="contract_type" required>
                    <option value="">-- Chọn loại hợp đồng --</option>
                    <option value="Hợp đồng thử việc" {{ old('contract_type', $contract->contract_type) == 'Hợp đồng thử việc' ? 'selected' : '' }}>Hợp đồng thử việc</option>
                    <option value="Hợp đồng xác định thời hạn" {{ old('contract_type', $contract->contract_type) == 'Hợp đồng xác định thời hạn' ? 'selected' : '' }}>Hợp đồng xác định thời hạn</option>
                    <option value="Hợp đồng không xác định thời hạn" {{ old('contract_type', $contract->contract_type) == 'Hợp đồng không xác định thời hạn' ? 'selected' : '' }}>Hợp đồng không xác định thời hạn</option>
                    <option value="Hợp đồng thời vụ" {{ old('contract_type', $contract->contract_type) == 'Hợp đồng thời vụ' ? 'selected' : '' }}>Hợp đồng thời vụ</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="start_date" name="start_date"
                            value="{{ old('start_date', $contract->start_date) }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                        <input type="date" class="form-control" id="end_date" name="end_date"
                            value="{{ old('end_date', $contract->end_date) }}">
                        <small class="text-muted">Để trống nếu hợp đồng không xác định thời hạn</small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="basic_salary" class="form-label">Lương cơ bản <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="basic_salary" name="basic_salary"
                    value="{{ old('basic_salary', $contract->basic_salary) }}" min="0" required>
                <small class="text-muted">Đơn vị: VNĐ</small>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <textarea class="form-control" id="note" name="note" rows="3">{{ old('note', $contract->note) }}</textarea>
                <small class="text-muted">Ghi chú về điều khoản đặc biệt, phúc lợi...</small>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending" {{ old('status', $contract->status) == 'pending' ? 'selected' : '' }}>Chưa hiệu lực</option>
                    <option value="active" {{ old('status', $contract->status) == 'active' ? 'selected' : '' }}>Đang hiệu lực</option>
                    <option value="expired" {{ old('status', $contract->status) == 'expired' ? 'selected' : '' }}>Hết hiệu lực</option>
                </select>
            </div>
            <div class="alert alert-info">

                <strong><i class="bx bx-file-blank"></i> Thông tin hợp đồng:</strong><br>
                <ul class="mb-0 mt-2">
                    <li>Trạng thái:
                        @if($contract->status == 'pending')
                        <span class="badge bg-info">Chưa hiệu lực</span>
                        @elseif($contract->status == 'active')
                        <span class="badge bg-success">Đang hiệu lực</span>
                        @else
                        <span class="badge bg-danger">Hết hiệu lực</span>
                        @endif
                    </li>
                   <li>Thời gian hợp đồng:
                        @if($contract->end_date)
                        Từ {{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }} đến
                        {{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}
                        @else
                        Từ {{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }} - Vô thời hạn
                        @endif

                   </li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection