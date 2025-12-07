@extends('admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Card chào mừng -->
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Chào mừng đến với hệ thống! 🎉</h5>
                            <p class="mb-4">
                                Hiện có <span class="fw-bold">{{ $totalEmployees }}</span> nhân viên 
                                trong <span class="fw-bold">{{ $totalDepartments }}</span> phòng ban. 
                                Hệ thống đang hoạt động tốt.
                            </p>
                            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-primary">Xem danh sách nhân viên</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                                src="../assets/img/illustrations/man-with-laptop-light.png"
                                height="140"
                                alt="Welcome"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Thống kê nhanh -->
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="bx bx-check-circle bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Hợp đồng hiệu lực</span>
                            <h3 class="card-title mb-2">{{ $activeContracts }}</h3>
                            <small class="text-success fw-semibold">Đang hoạt động</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="bx bx-time-five bx-sm"></i>
                                    </span>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Đơn đang chờ duyệt</span>
                            <h3 class="card-title text-nowrap mb-1">{{ $pendingLeaves }}</h3>
                            <small class="text-warning fw-semibold">Nghỉ phép chờ xử lý</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê phòng ban -->
        <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Thống kê phòng ban</h5>
                    <small class="text-muted">Top 5 phòng ban</small>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Tên phòng ban</th>
                                    <th>Quản lý</th>
                                    <th class="text-end">Số nhân viên</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topDepartments as $dept)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ strtoupper(substr($dept->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <strong>{{ $dept->name }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        @if($dept->manager)
                                            {{ $dept->manager->full_name }}
                                        @else
                                            <span class="text-muted">Chưa có</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-label-primary">{{ $dept->employees_count }} người</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">Chưa có dữ liệu phòng ban</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card thống kê nhỏ -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class="bx bx-calendar-check"></i>
                                    </span>
                                </div>
                            </div>
                            <span class="d-block mb-1">Chấm công</span>
                            <h3 class="card-title text-nowrap mb-2">{{ $attendanceThisMonth }}</h3>
                            <small class="text-muted">Lượt tháng {{ date('m/Y') }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class="bx bx-dollar-circle"></i>
                                    </span>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Tổng lương</span>
                            <h3 class="card-title mb-2">{{ number_format($salaryThisMonth/1000000, 1) }}M</h3>
                            <small class="text-muted">VNĐ tháng này</small>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Nhân viên mới</h5>
                                        <span class="badge bg-label-info rounded-pill">Tháng {{ date('m/Y') }}</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <h3 class="mb-0">{{ $newEmployees }}</h3>
                                        <small class="text-muted">người được tuyển dụng</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-user-plus" style="font-size: 4rem; color: #696cff; opacity: 0.8;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Thống kê hợp đồng chi tiết -->
        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Thống kê hợp đồng</h5>
                        <small class="text-muted">Tình trạng hợp đồng lao động</small>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-check-circle"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Hợp đồng hiệu lực</h6>
                                    <small class="text-muted">Đang hoạt động</small>
                                </div>
                                <div class="user-progress">
                                    <h5 class="mb-0 text-success">{{ $activeContracts }}</h5>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="bx bx-time"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Hợp đồng chờ xử lý</h6>
                                    <small class="text-muted">Đang chờ ký kết</small>
                                </div>
                                <div class="user-progress">
                                    <h5 class="mb-0 text-warning">{{ $pendingContracts }}</h5>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-user"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Tổng nhân viên</h6>
                                    <small class="text-muted">Trong hệ thống</small>
                                </div>
                                <div class="user-progress">
                                    <h5 class="mb-0 text-primary">{{ $totalEmployees }}</h5>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="bx bx-buildings"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Phòng ban</h6>
                                    <small class="text-muted">Tổng số phòng ban</small>
                                </div>
                                <div class="user-progress">
                                    <h5 class="mb-0 text-info">{{ $totalDepartments }}</h5>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Thống kê nghỉ phép -->
        <div class="col-md-6 col-lg-4 order-1 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title m-0">Thống kê nghỉ phép</h5>
                    <small class="text-muted">Tháng {{ date('m/Y') }}</small>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-around align-items-center mb-4">
                        <div class="text-center">
                            <div class="avatar avatar-lg mb-2">
                                <span class="avatar-initial rounded-circle bg-label-warning">
                                    <i class="bx bx-time-five bx-lg"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $pendingLeaves }}</h4>
                            <small class="text-muted">Chờ duyệt</small>
                        </div>
                        <div class="text-center">
                            <div class="avatar avatar-lg mb-2">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    <i class="bx bx-check-circle bx-lg"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $approvedLeaves }}</h4>
                            <small class="text-muted">Đã duyệt</small>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <h6 class="mb-3"><i class="bx bx-gift"></i> Thưởng & Kỷ luật</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-success"><i class="bx bx-trophy"></i> Thưởng tháng này:</span>
                            <strong class="text-success">{{ $recentRewards }}</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-danger"><i class="bx bx-error-circle"></i> Kỷ luật tháng này:</span>
                            <strong class="text-danger">{{ $recentDisciplines }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sinh nhật trong tháng -->
        <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">🎂 Sinh nhật tháng này</h5>
                </div>
                <div class="card-body">
                    <ul class="p-0 m-0">
                        @forelse($birthdayEmployees as $emp)
                        <li class="d-flex mb-3 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    {{ strtoupper(substr($emp->full_name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ $emp->full_name }}</h6>
                                    <small class="text-muted">{{ $emp->position }}</small>
                                </div>
                                <div class="user-progress text-end">
                                    <small class="fw-semibold text-primary">{{ \Carbon\Carbon::parse($emp->dob)->format('d/m') }}</small>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="text-center text-muted py-4">
                            Không có sinh nhật trong tháng này
                        </li>
                        @endforelse
                    </ul>
                    @if($birthdayEmployees->count() > 0)
                    <div class="text-center mt-3">
                        <a href="{{ route('employees.index') }}" class="btn btn-sm btn-outline-primary">
                            Xem tất cả nhân viên
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
