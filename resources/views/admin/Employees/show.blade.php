@extends('admin')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Nhân viên /</span> Chi tiết nhân viên
        </h4>
        <div>
            <a href="{{ route('employees.edit', $employee->employee_id) }}" class="btn btn-primary me-2">
                <i class='bx bx-edit'></i> Chỉnh sửa
            </a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">
                <i class='bx bx-arrow-back'></i> Quay lại
            </a>
        </div>
    </div>

    <!-- Thông tin cơ bản nhân viên -->
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="avatar avatar-xl mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-label-primary" style="font-size: 3rem;">
                                {{ strtoupper(substr($employee->full_name, 0, 1)) }}
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $employee->full_name }}</h4>
                        <span class="badge bg-label-primary">{{ $employee->position }}</span>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap mt-4">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-info rounded">
                                    <i class='bx bx-briefcase bx-sm'></i>
                                </div>
                            </div>
                            <div>
                                <small class="text-muted d-block">Hợp đồng</small>
                                <h6 class="mb-0">{{ $employee->contracts->count() }}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded">
                                    <i class='bx bx-calendar-check bx-sm'></i>
                                </div>
                            </div>
                            <div>
                                <small class="text-muted d-block">Chấm công</small>
                                <h6 class="mb-0">{{ $employee->attendances->count() }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Thông tin liên hệ</h5>
                    <div class="info-container">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <span class="fw-medium me-2"><i class='bx bx-envelope'></i> Email:</span>
                                <span>{{ $employee->email }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2"><i class='bx bx-phone'></i> Điện thoại:</span>
                                <span>{{ $employee->phone }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2"><i class='bx bx-map'></i> Địa chỉ:</span>
                                <span>{{ $employee->address }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Thông tin tài khoản -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Thông tin tài khoản</h5>
                    <div class="info-container">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <span class="fw-medium me-2"><i class='bx bx-user'></i> Username:</span>
                                <span>{{ $employee->user->email ?? 'Chưa có tài khoản' }}</span>
                            </li>
                            <li class="mb-3">
                                <span class="fw-medium me-2"><i class='bx bx-lock'></i> Password:</span>
                                <span>***********</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <!-- Thông tin chi tiết -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Thông tin cá nhân</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Mã nhân viên:</label>
                            <p class="text-muted">{{ $employee->employee_id }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Giới tính:</label>
                            <p class="text-muted">
                                @if ($employee->gender == 'M')
                                <span class="badge bg-label-primary">Nam</span>
                                @else
                                <span class="badge bg-label-danger">Nữ</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Ngày sinh:</label>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($employee->dob)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Ngày vào làm:</label>
                            <p class="text-muted">{{ \Carbon\Carbon::parse($employee->hire_date)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Phòng ban:</label>
                            <p class="text-muted">{{ $employee->department->name ?? 'Chưa có phòng ban' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-medium">Chức vụ:</label>
                            <p class="text-muted">{{ $employee->position }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs cho các thông tin khác -->
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-fill flex-column flex-sm-row" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#contracts" aria-controls="contracts" aria-selected="true">
                                <i class='bx bx-file me-1'></i> <span class="d-none d-lg-inline">Hợp đồng</span><span class="d-inline d-lg-none">HĐ</span> ({{ $employee->contracts->count() }})
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#attendances" aria-controls="attendances" aria-selected="false">
                                <i class='bx bx-calendar-check me-1'></i> <span class="d-none d-lg-inline">Chấm công</span><span class="d-inline d-lg-none">CC</span> ({{ $employee->attendances->count() }})
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#leaves" aria-controls="leaves" aria-selected="false">
                                <i class='bx bx-calendar-minus me-1'></i> <span class="d-none d-lg-inline">Nghỉ phép</span><span class="d-inline d-lg-none">NP</span> ({{ $employee->leaves->count() }})
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#rewards" aria-controls="rewards" aria-selected="false">
                                <i class='bx bx-trophy me-1'></i> <span class="d-none d-lg-inline">KT/KL</span><span class="d-inline d-lg-none">KT</span> ({{ $employee->rewardsDisciplines->count() }})
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#salaries" aria-controls="salaries" aria-selected="false">
                                <i class='bx bx-money me-1'></i> <span class="d-none d-md-inline">Lương</span> ({{ $employee->salaries->count() }})
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content p-3">
                        <!-- Hợp đồng -->
                        <div class="tab-pane fade show active" id="contracts" role="tabpanel">
                            @if($employee->contracts->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px;">Mã</th>
                                            <th style="min-width: 100px;">Loại HĐ</th>
                                            <th style="min-width: 90px;">Bắt đầu</th>
                                            <th style="min-width: 90px;">Kết thúc</th>
                                            <th style="min-width: 110px;" class="text-end">Lương CB</th>
                                            <th style="min-width: 110px;">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->contracts as $contract)
                                        <tr>
                                            <td>{{ $contract->contract_id }}</td>
                                            <td>{{ $contract->contract_type }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contract->start_date)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($contract->end_date)->format('d/m/Y') }}</td>
                                            <td class="text-end">{{ number_format($contract->basic_salary, 0, ',', '.') }}</td>
                                            <td>
                                                @if($contract->status == 'active')
                                                <span class="badge bg-success">Hoạt động</span>
                                                @else
                                                <span class="badge bg-secondary">Kết thúc</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class='bx bx-file bx-lg text-muted'></i>
                                <p class="text-muted">Chưa có hợp đồng nào</p>
                            </div>
                            @endif
                        </div>

                        <!-- Chấm công -->
                        <div class="tab-pane fade" id="attendances" role="tabpanel">
                            @if($employee->attendances->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px;">Mã</th>
                                            <th style="min-width: 90px;">Ngày</th>
                                            <th style="min-width: 80px;" class="text-center">Vào</th>
                                            <th style="min-width: 80px;" class="text-center">Ra</th>
                                            <th style="min-width: 100px;" class="text-center">Tổng giờ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->attendances->sortByDesc('date')->take(20) as $attendance)
                                        <tr>
                                            <td>{{ $attendance->attendance_id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-label-success">
                                                    {{ $attendance->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('H:i') : '--:--' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-label-danger">
                                                    {{ $attendance->check_out ? \Carbon\Carbon::parse($attendance->check_out)->format('H:i') : '--:--' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($attendance->check_in && $attendance->check_out)
                                                @php
                                                $checkIn = \Carbon\Carbon::parse($attendance->check_in);
                                                $checkOut = \Carbon\Carbon::parse($attendance->check_out);
                                                $diff = $checkIn->diff($checkOut);
                                                @endphp
                                                {{ $diff->h }}h {{ $diff->i }}p
                                                @else
                                                --
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class='bx bx-calendar-check bx-lg text-muted'></i>
                                <p class="text-muted">Chưa có dữ liệu chấm công</p>
                            </div>
                            @endif
                        </div>

                        <!-- Nghỉ phép -->
                        <div class="tab-pane fade" id="leaves" role="tabpanel">
                            @if($employee->leaves->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px;">Mã</th>
                                            <th style="min-width: 100px;">Loại</th>
                                            <th style="min-width: 90px;">Từ ngày</th>
                                            <th style="min-width: 90px;">Đến ngày</th>
                                            <th style="min-width: 70px;" class="text-center">Số ngày</th>
                                            <th style="min-width: 90px;">Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->leaves as $leave)
                                        <tr>
                                            <td>{{ $leave->leave_id }}</td>
                                            <td>{{ $leave->leave_type }}</td>
                                            <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                @php
                                                $start = \Carbon\Carbon::parse($leave->start_date);
                                                $end = \Carbon\Carbon::parse($leave->end_date);
                                                $days = $start->diffInDays($end) + 1;
                                                @endphp
                                                <span class="badge bg-label-info">{{ $days }}</span>
                                            </td>
                                            <td>
                                                @if($leave->status == 'approved')
                                                <span class="badge bg-success">Duyệt</span>
                                                @elseif($leave->status == 'pending')
                                                <span class="badge bg-warning">Chờ</span>
                                                @else
                                                <span class="badge bg-danger">Từ chối</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class='bx bx-calendar-minus bx-lg text-muted'></i>
                                <p class="text-muted">Chưa có đơn nghỉ phép nào</p>
                            </div>
                            @endif
                        </div>

                        <!-- Khen thưởng/Kỷ luật -->
                        <div class="tab-pane fade" id="rewards" role="tabpanel">
                            @if($employee->rewardsDisciplines->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px;">Mã</th>
                                            <th style="min-width: 90px;">Loại</th>
                                            <th style="min-width: 120px;">Tiêu đề</th>
                                            <th style="min-width: 150px;">Mô tả</th>
                                            <th style="min-width: 110px;" class="text-end">Số tiền</th>
                                            <th style="min-width: 90px;">Ngày</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->rewardsDisciplines as $record)
                                        <tr>
                                            <td>{{ $record->record_id }}</td>
                                            <td>
                                                @if($record->type == 'reward')
                                                <span class="badge bg-success">KT</span>
                                                @else
                                                <span class="badge bg-danger">KL</span>
                                                @endif
                                            </td>
                                            <td>{{ $record->title }}</td>
                                            <td><small>{{ $record->description }}</small></td>
                                            <td class="text-end">
                                                <span class="{{ $record->type == 'reward' ? 'text-success' : 'text-danger' }}">
                                                    {{ $record->type == 'reward' ? '+' : '-' }}{{ number_format($record->amount, 0, ',', '.') }}
                                                </span>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($record->date_recorded)->format('d/m/Y') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class='bx bx-trophy bx-lg text-muted'></i>
                                <p class="text-muted">Chưa có thông tin khen thưởng/kỷ luật</p>
                            </div>
                            @endif
                        </div>

                        <!-- Lương -->
                        <div class="tab-pane fade" id="salaries" role="tabpanel">
                            @if($employee->salaries->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th style="min-width: 50px;">Mã</th>
                                            <th style="min-width: 90px;">Tháng</th>
                                            <th style="min-width: 70px;" class="text-center">Công</th>
                                            <th style="min-width: 100px;" class="text-end">L.Cơ bản</th>
                                            <th style="min-width: 90px;" class="text-end">P.Cấp</th>
                                            <th style="min-width: 90px;" class="text-end">Thưởng</th>
                                            <th style="min-width: 90px;" class="text-end">K.Trừ</th>
                                            <th style="min-width: 120px;" class="text-end">Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employee->salaries->sortByDesc('year')->sortByDesc('month') as $salary)
                                        <tr>
                                            <td>{{ $salary->salary_id }}</td>
                                            <td><span class="badge bg-label-primary">{{ $salary->month }}/{{ $salary->year }}</span></td>
                                            <td class="text-center">{{ $salary->work_day }}</td>
                                            <td class="text-end">{{ number_format($salary->basic_salary, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($salary->allowance, 0, ',', '.') }}</td>
                                            <td class="text-end text-info">{{ number_format($salary->bonus, 0, ',', '.') }}</td>
                                            <td class="text-end text-danger">{{ number_format($salary->deduction, 0, ',', '.') }}</td>
                                            <td class="text-end fw-bold text-success">{{ number_format($salary->total_salary, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class='bx bx-money bx-lg text-muted'></i>
                                <p class="text-muted">Chưa có dữ liệu lương</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection