@extends('admin')
@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Quản lý hợp đồng</h4>
            <p class="text-muted ">Danh sách và trạng thái hợp đồng nhân viên</p>
        </div>
        <a class="btn btn-primary shadow-sm" href="{{ route('contracts.create') }}">
            <i class="bi bi-plus-lg me-1"></i> Thêm hợp đồng mới
        </a>
    </div>

    <div class="row g-2">
        @foreach($contracts as $contract)
        <div class="col-12 col-md-6 col-xl-3 mb-3">
            <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-start pt-3">
                    <span class="text-muted small fw-bold">#{{ $contract->contract_id }}</span>
                    @php
                        $statusClass = [
                            'pending' => 'bg-label-info',
                            'active' => 'bg-label-success',
                            'expired' => 'bg-label-danger'
                        ][$contract->status] ?? 'bg-label-secondary';
                        
                        $statusText = [
                            'pending' => 'Chưa hiệu lực',
                            'active' => 'Đang hiệu lực',
                            'expired' => 'Hết hiệu lực'
                        ][$contract->status] ?? 'N/A';
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                </div>

                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-grow-1">
                            @if($contract->employee)
                                @include('layouts.admin.userInfo', ['employee' => $contract->employee])
                            @else
                                <h6 class="mb-0 text-muted">Không xác định</h6>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        @php
                            $contractTypeColors = [
                                'Hợp đồng thử việc' => 'warning',
                                'Hợp đồng xác định thời hạn' => 'info',
                                'Hợp đồng không xác định thời hạn' => 'success',
                                'Hợp đồng thời vụ' => 'secondary',
                            ];
                            $badgeColor = $contractTypeColors[$contract->contract_type] ?? 'primary';
                        @endphp
                        <div class="d-flex align-items-center">
                            <i class="bi bi-file-earmark-text me-2 text-{{ $badgeColor }}"></i>
                            <span class="fw-semibold">{{ $contract->contract_type }}</span>
                        </div>
                    </div>

                    <div class="row g-2 bg-light rounded p-2 mb-3">
                        <div class="col-6">
                            <small class="text-muted d-block">Bắt đầu</small>
                            <span class="small fw-bold">{{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}</span>
                        </div>
                        <div class="col-6 border-start ps-3">
                            <small class="text-muted d-block">Kết thúc</small>
                            <span class="small fw-bold">
                                {{ $contract->end_date ? \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') : '∞' }}
                            </span>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <small class="text-muted d-block">Lương cơ bản</small>
                            <span class="text-primary fw-bold fs-5">{{ number_format($contract->basic_salary, 0, ',', '.') }} đ</span>
                        </div>
                    </div>

                    <form action="{{ route('contracts.renew', $contract->contract_id) }}" method="post" class="mb-1">
                        @csrf
                        @method('PUT')
                        <div class="input-group input-group-sm">
                            <input type="date" name="end_date" class="form-control" title="Chọn ngày gia hạn" required>
                            <button class="btn btn-outline-primary" type="submit">Gia hạn</button>
                        </div>
                    </form>
                </div>

                <div class="card-footer bg-transparent border-top d-flex justify-content-between py-3">
                    <a href="{{ route('contracts.edit', $contract->contract_id) }}" class="btn btn-sm btn-outline-warning w-50 me-2">
                        <i class="bi bi-pencil-square"></i> Sửa
                    </a>
                    <form action="{{ route('contracts.destroy', $contract->contract_id) }}" method="POST" class="w-50" onsubmit="return confirm('Xóa hợp đồng này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash"></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
    .bg-label-success { background-color: #e8fadf; color: #71dd37; }
    .bg-label-info { background-color: #e1f0ff; color: #03c3ec; }
    .bg-label-danger { background-color: #ffe5e5; color: #ff3e1d; }
    .bg-label-secondary { background-color: #ebeef0; color: #8592a3; }
</style>

@endsection