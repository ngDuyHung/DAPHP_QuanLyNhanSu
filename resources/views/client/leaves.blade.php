@extends('client')

@section('title', 'Quản lý nghỉ phép')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ /</span> Đơn nghỉ phép</h4>

<div class="row">
    <!-- Form tạo đơn mới (Bên trái) -->
    <div class="col-md-4">
        <div class="card mb-4">
            <h5 class="card-header">Tạo đơn nghỉ phép</h5>
            <div class="card-body">
                <form action="{{ route('client.leaves.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="leave_type" class="form-label">Loại nghỉ phép <span class="text-danger">*</span></label>
                        <select class="form-select" id="leave_type" name="leave_type" required>
                            <option value="">-- Chọn loại --</option>
                            <option value="Nghỉ phép năm" {{ old('leave_type') == 'Nghỉ phép năm' ? 'selected' : '' }}>Nghỉ phép năm</option>
                            <option value="Nghỉ ốm" {{ old('leave_type') == 'Nghỉ ốm' ? 'selected' : '' }}>Nghỉ ốm</option>
                            <option value="Nghỉ không lương" {{ old('leave_type') == 'Nghỉ không lương' ? 'selected' : '' }}>Nghỉ không lương</option>
                            <option value="Nghỉ thai sản" {{ old('leave_type') == 'Nghỉ thai sản' ? 'selected' : '' }}>Nghỉ thai sản</option>
                            <option value="Nghỉ hiếu" {{ old('leave_type') == 'Nghỉ hiếu' ? 'selected' : '' }}>Nghỉ hiếu</option>
                            <option value="Nghỉ cưới" {{ old('leave_type') == 'Nghỉ cưới' ? 'selected' : '' }}>Nghỉ cưới</option>
                            <option value="Khác" {{ old('leave_type') == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Ngày bắt đầu <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">Ngày kết thúc <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary w-100">Gửi đơn</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Danh sách đơn nghỉ (Bên phải) -->
    <div class="col-md-8">
        <div class="card">
            <h5 class="card-header">Lịch sử nghỉ phép</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Loại</th>
                            <th>Thời gian</th>
                            <th>Số ngày</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse($Leaves as $leave)
                        <tr>
                            <td><strong>#{{ $leave->leave_id }}</strong></td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($leave->start_date)->format('d/m/Y') }} <br>
                                <small>đến</small> {{ \Carbon\Carbon::parse($leave->end_date)->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}
                            </td>
                            <td>
                                @if($leave->status == 'Approved' || $leave->status == 'approved')
                                    <span class="badge bg-label-success">Đã duyệt</span>
                                @elseif($leave->status == 'Rejected' || $leave->status == 'rejected')
                                    <span class="badge bg-label-danger">Từ chối</span>
                                @else
                                    <span class="badge bg-label-warning">Chờ duyệt</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Chưa có đơn nghỉ phép nào</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection