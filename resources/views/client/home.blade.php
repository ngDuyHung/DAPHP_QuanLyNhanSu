@extends('client')

@section('title', 'Trang chủ nhân viên')

@section('content')
<style>
    .digital-clock {
        font-family: 'Courier New', Courier, monospace;
        font-weight: bold;
        letter-spacing: 2px;
        text-shadow: 0 0 10px rgba(105, 108, 255, 0.5);
    }
</style>

<div class="row">
    <!-- Profile Card -->
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mx-auto mb-3" style="width: 120px; height: 120px; position: relative;">
                    @if($employee->img_link)
                        <img src="{{ asset('storage/' . $employee->img_link) }}" alt="Avatar" class="w-100 h-100 rounded-circle object-fit-cover border border-3 border-primary">
                    @else
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="w-100 h-100 rounded-circle object-fit-cover border border-3 border-primary">
                    @endif
                    <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-2"></span>
                </div>
                <h4 class="mb-1">{{ $employee->full_name }}</h4>
                <p class="text-muted mb-1">{{ $employee->position }}</p>
                <span class="badge bg-label-primary">{{ $employee->department->name ?? 'Chưa cập nhật' }}</span>
            </div>
            <div class="card-body border-top">
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-id-card me-2 text-primary"></i>
                        <span class="fw-semibold me-auto">Mã NV:</span>
                        <span>{{ $employee->employee_id }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-user me-2 text-primary"></i>
                        <span class="fw-semibold me-auto">Giới tính:</span>
                        <span>
                            @if($employee->gender == 'M') Nam 
                            @elseif($employee->gender == 'F') Nữ 
                            @else Khác @endif
                        </span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-calendar me-2 text-primary"></i>
                        <span class="fw-semibold me-auto">Ngày sinh:</span>
                        <span>{{ $employee->dob }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-briefcase me-2 text-primary"></i>
                        <span class="fw-semibold me-auto">Ngày vào làm:</span>
                        <span>{{ $employee->hire_date }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-envelope me-2 text-primary"></i>
                        <span class="fw-semibold me-auto">Email:</span>
                        <span>{{ $employee->email }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="bx bx-phone me-2 text-primary"></i>
                        <span class="fw-semibold me-auto">SĐT:</span>
                        <span>{{ $employee->phone }}</span>
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="bx bx-map me-2 text-primary"></i>
                        <span class="fw-semibold me-auto">Địa chỉ:</span>
                        <span class="text-end" style="max-width: 150px;">{{ $employee->address }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Actions & Stats -->
    <div class="col-md-8">
        <div class="row">
            <!-- Attendance -->
            <div class="col-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Chấm công</h5>
                        <small class="text-muted">{{ date('d/m/Y') }}</small>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="display-3 text-primary digital-clock" id="clock">00:00:00</div>
                            <p class="text-muted" id="date">Loading date...</p>
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <form action="{{ route('client.attendance.checkin') }}" method="POST">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class='bx bx-log-in-circle me-2'></i> Chấm công vào
                                </button>
                            </form>
                            
                            <form action="{{ route('client.attendance.checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="employee_id" value="{{ $employee->employee_id }}">
                                <button type="submit" class="btn btn-danger btn-lg px-5">
                                    <i class='bx bx-log-out-circle me-2'></i> Chấm công ra
                                </button>
                            </form>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-muted mb-0">Vui lòng check-in khi bắt đầu làm việc và check-out khi kết thúc.</p>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function updateClock() {
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    
                    document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
                    
                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                    document.getElementById('date').textContent = now.toLocaleDateString('vi-VN', options);
                }

                setInterval(updateClock, 1000);
                updateClock(); // Initial call
            </script>

            <!-- Salary -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column align-items-center text-center">
                        <div class="avatar avatar-xl mb-3 bg-label-success rounded p-2">
                            <i class='bx bx-money fs-1'></i>
                        </div>
                        <h5 class="card-title">Lương & Thưởng</h5>
                        <p class="card-text mb-4">Xem chi tiết bảng lương hàng tháng và các khoản thưởng phạt.</p>
                        <a href="{{ route('client.salary.show', $employee->employee_id) }}" class="btn btn-outline-success mt-auto w-100">Xem chi tiết</a>
                    </div>
                </div>
            </div>

            <!-- Leaves -->
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column align-items-center text-center">
                        <div class="avatar avatar-xl mb-3 bg-label-warning rounded p-2">
                            <i class='bx bx-calendar-minus fs-1'></i>
                        </div>
                        <h5 class="card-title">Nghỉ phép</h5>
                        <p class="card-text mb-4">Tạo đơn xin nghỉ phép và theo dõi trạng thái phê duyệt.</p>
                        <a href="{{ route('client.leaves.index', $employee->employee_id) }}" class="btn btn-outline-warning mt-auto w-100">Quản lý nghỉ phép</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
