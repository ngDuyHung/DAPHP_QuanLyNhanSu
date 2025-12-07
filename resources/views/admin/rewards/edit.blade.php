@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sửa bản ghi thưởng/phạt</h5>
        <small class="text-muted float-end">Cập nhật thông tin thưởng/phạt</small>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('rewards.update', $reward->record_id) }}">
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
                                    {{ old('employee_id', $reward->employee_id) == $employee->employee_id ? 'selected' : '' }}>
                                    {{ $employee->full_name }} - {{ $employee->position }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label">Loại <span class="text-danger">*</span></label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">-- Chọn loại --</option>
                            <option value="reward" {{ old('type', $reward->type) == 'reward' ? 'selected' : '' }}>
                                Thưởng
                            </option>
                            <option value="discipline" {{ old('type', $reward->type) == 'discipline' ? 'selected' : '' }}>
                                Phạt
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" 
                    value="{{ old('title', $reward->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả chi tiết</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $reward->description) }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Số tiền <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="amount" name="amount" 
                            value="{{ old('amount', abs($reward->amount)) }}" min="0" required>
                        <small class="text-muted">Đơn vị: VNĐ (không cần dấu +/- , hệ thống tự động xử lý)</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_recorded" class="form-label">Ngày ghi nhận <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date_recorded" name="date_recorded" 
                            value="{{ old('date_recorded', $reward->date_recorded) }}" required>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <strong><i class="bx bx-info-circle"></i> Thông tin bản ghi:</strong><br>
                <ul class="mb-0 mt-2">
                    <li>Loại hiện tại: 
                        @if($reward->type == 'reward')
                            <span class="badge bg-success"><i class="bx bx-trophy"></i> Thưởng</span>
                        @else
                            <span class="badge bg-danger"><i class="bx bx-error-circle"></i> Phạt</span>
                        @endif
                    </li>
                    <li>Số tiền hiện tại: 
                        @if($reward->type == 'reward')
                            <span class="text-success fw-bold">+{{ number_format($reward->amount, 0, ',', '.') }} đ</span>
                        @else
                            <span class="text-danger fw-bold">-{{ number_format(abs($reward->amount), 0, ',', '.') }} đ</span>
                        @endif
                    </li>
                    <li>Ngày ghi nhận: <strong>{{ \Carbon\Carbon::parse($reward->date_recorded)->format('d/m/Y') }}</strong></li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('rewards.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
