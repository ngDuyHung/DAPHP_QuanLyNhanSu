@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý hợp đồng</h4>

                <a class="btn btn-primary" href="{{ route('contracts.create') }}">
                    Thêm hợp đồng
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã hợp đồng</th>
                    <th>Nhân viên</th>
                    <th>Loại hợp đồng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Thời hạn</th>
                    <th>Lương cơ bản</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($contracts as $contract)
                <tr>
                    <td>{{ $contract->contract_id }}</td>
                    <td>
                        @if($contract->employee)
                        @include('layouts.admin.userInfo', ['employee' => $contract->employee])
                        @else
                        <span class="text-muted">Không xác định</span>
                        @endif
                    </td>
                    <td>
                        @php
                        $contractTypeColors = [
                        'Hợp đồng thử việc' => 'warning',
                        'Hợp đồng xác định thời hạn' => 'info',
                        'Hợp đồng không xác định thời hạn' => 'success',
                        'Hợp đồng thời vụ' => 'secondary',
                        ];
                        $badgeColor = $contractTypeColors[$contract->contract_type] ?? 'primary';
                        @endphp
                        <span class="badge bg-{{ $badgeColor }}">{{ $contract->contract_type }}</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}</td>
                    <td>
                        @if($contract->end_date)
                        {{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}
                        @else
                        <span class="text-muted">Không xác định</span>
                        @endif
                    </td>
                    <td>
                        {{ $contract->end_date }}
                    </td>
                    <td class="text-end">
                        <strong>{{ number_format($contract->basic_salary, 0, ',', '.') }} đ</strong>
                    </td>
                    <td>
                        @if($contract->status == 'pending')
                        <span class="badge bg-info">Chưa hiệu lực</span>
                        @elseif($contract->status == 'active')
                        <span class="badge bg-success">Đang hiệu lực</span>
                        @else
                        <span class="badge bg-danger">Hết hiệu lực</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('contracts.edit', $contract->contract_id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('contracts.destroy', $contract->contract_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa hợp đồng này không?')">Xóa</button>
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