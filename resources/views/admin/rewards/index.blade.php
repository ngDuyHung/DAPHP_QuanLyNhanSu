@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý thưởng/phạt</h4>

                <a class="btn btn-primary" href="{{ route('rewards.create') }}">
                    Thêm bản ghi
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã</th>
                    <th>Nhân viên</th>
                    <th>Loại</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Số tiền</th>
                    <th>Ngày ghi nhận</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($rewards as $reward)
                <tr>
                    <td>{{ $reward->record_id }}</td>
                    <td>    
                        @if($reward->employee)
                        @include('layouts.admin.userInfo', ['employee' => $reward->employee])
                        @else
                        <span class="text-muted">Không xác định</span>
                        @endif
                    </td>
                    <td>
                        @if($reward->type == 'reward')
                        <span class="badge bg-success">
                            <i class="bx bx-trophy"></i> Thưởng
                        </span>
                        @else
                        <span class="badge bg-danger">
                            <i class="bx bx-error-circle"></i> Phạt
                        </span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $reward->title }}</strong>
                    </td>
                    <td>
                        @if($reward->description)
                        <small>{{ Str::limit($reward->description, 50) }}</small>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if($reward->type == 'reward')
                        <span class="text-success fw-bold">
                            +{{ number_format($reward->amount, 0, ',', '.') }} đ
                        </span>
                        @else
                        <span class="text-danger fw-bold">
                            -{{ number_format($reward->amount, 0, ',', '.') }} đ
                        </span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($reward->date_recorded)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('rewards.edit', $reward->record_id) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('rewards.destroy', $reward->record_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này không?')">Xóa</button>
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