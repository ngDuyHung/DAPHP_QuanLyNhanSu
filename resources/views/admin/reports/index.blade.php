@extends('admin')
@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lý /</span> Báo cáo & Thống kê</h4>

<div class="row">
    <!-- Báo cáo nhân sự theo phòng ban -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">
                    <i class='bx bxs-business'></i> Báo cáo nhân sự theo phòng ban
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('reports.show', 'employee-by-department') }}" method="GET" target="_blank">
                    <div class="mb-3">
                        <label for="department_id" class="form-label">Chọn phòng ban</label>
                        <select class="form-select" id="department_id" name="department_id">
                            <option value="">Tất cả phòng ban</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->department_id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" name="format" value="view" class="btn btn-primary">
                            <i class='bx bx-show'></i> Xem báo cáo
                        </button>
                        <button type="submit" name="format" value="pdf" class="btn btn-danger">
                            <i class='bx bxs-file-pdf'></i> Xuất PDF
                        </button>
                        <button type="submit" name="format" value="excel" class="btn btn-success">
                            <i class='bx bxs-file'></i> Xuất Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Báo cáo chấm công -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">
                    <i class='bx bx-time-five'></i> Báo cáo chấm công
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('reports.show', 'attendance') }}" method="GET" target="_blank">
                    <div class="mb-3">
                        <label for="att_month" class="form-label">Chọn tháng</label>
                        <input type="month" class="form-control" id="att_month" name="month" value="{{ date('Y-m') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="att_employee" class="form-label">Nhân viên (tùy chọn)</label>
                        <select class="form-select" id="att_employee" name="employee_id">
                            <option value="">Tất cả nhân viên</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->employee_id }}">{{ $emp->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" name="format" value="view" class="btn btn-primary">
                            <i class='bx bx-show'></i> Xem báo cáo
                        </button>
                        <button type="submit" name="format" value="pdf" class="btn btn-danger">
                            <i class='bx bxs-file-pdf'></i> Xuất PDF
                        </button>
                        <button type="submit" name="format" value="excel" class="btn btn-success">
                            <i class='bx bxs-file'></i> Xuất Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Báo cáo nghỉ phép -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">
                    <i class='bx bx-calendar-minus'></i> Báo cáo nghỉ phép
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('reports.show', 'leaves') }}" method="GET" target="_blank">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="leave_start" class="form-label">Từ ngày</label>
                            <input type="date" class="form-control" id="leave_start" name="start_date" value="{{ date('Y-m-01') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="leave_end" class="form-label">Đến ngày</label>
                            <input type="date" class="form-control" id="leave_end" name="end_date" value="{{ date('Y-m-t') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="leave_status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="leave_status" name="status">
                            <option value="">Tất cả</option>
                            <option value="Pending">Chờ duyệt</option>
                            <option value="Approved">Đã duyệt</option>
                            <option value="Rejected">Từ chối</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" name="format" value="view" class="btn btn-primary">
                            <i class='bx bx-show'></i> Xem báo cáo
                        </button>
                        <button type="submit" name="format" value="pdf" class="btn btn-danger">
                            <i class='bx bxs-file-pdf'></i> Xuất PDF
                        </button>
                        <button type="submit" name="format" value="excel" class="btn btn-success">
                            <i class='bx bxs-file'></i> Xuất Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Báo cáo bảng lương -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">
                    <i class='bx bx-money'></i> Báo cáo bảng lương
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('reports.show', 'salary') }}" method="GET" target="_blank">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="salary_month" class="form-label">Tháng</label>
                            <select class="form-select" id="salary_month" name="month" required>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>Tháng {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="salary_year" class="form-label">Năm</label>
                            <select class="form-select" id="salary_year" name="year" required>
                                @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="salary_department" class="form-label">Phòng ban (tùy chọn)</label>
                        <sel@foreach($departments as $dept)
                                <option value="{{ $dept->department_id }}">{{ $dept->name }}</option>
                            @endforeachdepartment_id">
                            <option value="">Tất cả phòng ban</option>
                            <!-- Dữ liệu phòng ban sẽ được load từ controller -->
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" name="format" value="view" class="btn btn-primary">
                            <i class='bx bx-show'></i> Xem báo cáo
                        </button>
                        <button type="submit" name="format" value="pdf" class="btn btn-danger">
                            <i class='bx bxs-file-pdf'></i> Xuất PDF
                        </button>
                        <button type="submit" name="format" value="excel" class="btn btn-success">
                            <i class='bx bxs-file'></i> Xuất Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Thống kê tổng quan -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class='bx bx-bar-chart'></i> Thống kê tổng quan hệ thống</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 text-center">
                            <i class='bx bx-user-circle bx-lg text-primary mb-2'></i>
                            <h4 class="mb-1">{{ \App\Models\Employees::count() }}</h4>
                            <small class="text-muted">Tổng nhân viên</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 text-center">
                            <i class='bx bx-buildings bx-lg text-success mb-2'></i>
                            <h4 class="mb-1">{{ \App\Models\Departments::count() }}</h4>
                            <small class="text-muted">Phòng ban</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 text-center">
                            <i class='bx bx-calendar-minus bx-lg text-warning mb-2'></i>
                            <h4 class="mb-1">{{ \App\Models\Leaves::whereMonth('start_date', date('m'))->count() }}</h4>
                            <small class="text-muted">Đơn nghỉ tháng này</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="border rounded p-3 text-center">
                            <i class='bx bx-time-five bx-lg text-info mb-2'></i>
                            <h4 class="mb-1">{{ \App\Models\Attendance::whereDate('check_in', date('Y-m-d'))->count() }}</h4>
                            <small class="text-muted">Chấm công hôm nay</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection