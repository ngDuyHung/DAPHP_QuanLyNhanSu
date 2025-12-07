@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thêm bản ghi thưởng/phạt</h5>
        <small class="text-muted float-end">Nhập thông tin thưởng/phạt</small>
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

        <form method="POST" action="{{ route('rewards.store') }}">
            @csrf
            
            <div class="row">
                <div class="col-md-6">
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
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="type" class="form-label">Loại <span class="text-danger">*</span></label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">-- Chọn loại --</option>
                            <option value="reward" {{ old('type') == 'reward' ? 'selected' : '' }}>
                                <i class="bx bx-trophy"></i> Thưởng
                            </option>
                            <option value="discipline" {{ old('type') == 'discipline' ? 'selected' : '' }}>
                                <i class="bx bx-error-circle"></i> Phạt
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" 
                    value="{{ old('title') }}" placeholder="Ví dụ: Hoàn thành xuất sắc dự án..." required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Mô tả chi tiết</label>
                <textarea class="form-control" id="description" name="description" rows="3" 
                    placeholder="Ghi chú chi tiết về lý do thưởng/phạt...">{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Số tiền <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="amount" name="amount" 
                            value="{{ old('amount') }}" min="0" placeholder="0" required>
                        <small class="text-muted">Đơn vị: VNĐ (không cần dấu +/- , hệ thống tự động xử lý)</small>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="date_recorded" class="form-label">Ngày ghi nhận <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="date_recorded" name="date_recorded" 
                            value="{{ old('date_recorded', date('Y-m-d')) }}" required>
                    </div>
                </div>
            </div>

            <div class="alert alert-info">
                <strong><i class="bx bx-info-circle"></i> Lưu ý:</strong>
                <ul class="mb-0 mt-2">
                    <li><strong>Thưởng:</strong> Dành cho nhân viên có thành tích xuất sắc, hoàn thành vượt mức KPI...</li>
                    <li><strong>Phạt:</strong> Vi phạm nội quy, đi muộn, làm sai quy trình...</li>
                    <li>Số tiền nhập là số dương, hệ thống sẽ tự động thêm dấu +/- khi hiển thị</li>
                    <li>Mô tả chi tiết giúp theo dõi và đánh giá nhân viên chính xác hơn</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('rewards.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
