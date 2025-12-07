@extends('admin')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">
            <span class="text-muted fw-light">Phòng ban /</span> Chi tiết phòng ban
        </h4>
        <div>
            <a href="{{ route('departments.edit', $department->department_id) }}" class="btn btn-primary me-2">
                <i class='bx bx-edit'></i> Chỉnh sửa
            </a>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">
                <i class='bx bx-arrow-back'></i> Quay lại
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Thông tin phòng ban -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="avatar avatar-xl mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-label-primary" style="font-size: 3rem;">
                                <i class='bx bx-buildings'></i>
                            </span>
                        </div>
                        <h4 class="mb-1">{{ $department->name }}</h4>
                        <span class="badge bg-label-info">Mã PB: {{ $department->department_id }}</span>
                    </div>

                    <div class="d-flex justify-content-around mt-4 pt-3 border-top">
                        <div class="text-center">
                            <div class="avatar mx-auto mb-2">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    <i class='bx bx-user bx-sm'></i>
                                </span>
                            </div>
                            <h5 class="mb-0">{{ $department->employees->count() }}</h5>
                            <small class="text-muted">Nhân viên</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông tin trưởng phòng -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class='bx bx-user-circle me-2'></i>Trưởng phòng
                    </h5>
                    @if($department->manager)
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar avatar-lg me-3">
                            <span class="avatar-initial rounded-circle bg-label-primary">
                                {{ strtoupper(substr($department->manager->full_name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $department->manager->full_name }}</h6>
                            <small class="text-muted">{{ $department->manager->position }}</small>
                        </div>
                    </div>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class='bx bx-envelope me-2'></i>
                            <small>{{ $department->manager->email }}</small>
                        </li>
                        <li class="mb-2">
                            <i class='bx bx-phone me-2'></i>
                            <small>{{ $department->manager->phone }}</small>
                        </li>
                        <li>
                            <a href="{{ route('employees.show', $department->manager->employee_id) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                                <i class='bx bx-show me-1'></i>Xem chi tiết
                            </a>
                        </li>
                    </ul>
                    @else
                    <div class="text-center py-4">
                        <i class='bx bx-user-x bx-lg text-muted mb-2'></i>
                        <p class="text-muted mb-0">Chưa có trưởng phòng</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Danh sách nhân viên -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class='bx bx-group me-2'></i>Danh sách nhân viên
                    </h5>
                    <span class="badge bg-primary">{{ $department->employees->count() }} người</span>
                </div>
                <div class="card-body">
                    @if($department->employees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th style="min-width: 50px;"><small>Mã NV</small></th>
                                    <th style="min-width: 150px;"><small>Họ tên</small></th>
                                    <th style="min-width: 120px;"><small>Chức vụ</small></th>
                                    <th style="min-width: 100px;"><small>Email</small></th>
                                    <th style="min-width: 100px;"><small>Điện thoại</small></th>
                                    <th style="min-width: 90px;" class="text-center"><small>Trạng thái</small></th>
                                    <th style="min-width: 80px;" class="text-center"><small>Thao tác</small></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($department->employees as $employee)
                                <tr>
                                    <td>{{ $employee->employee_id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ strtoupper(substr($employee->full_name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $employee->full_name }}</span>
                                                @if($department->manager_id == $employee->employee_id)
                                                <span class="badge bg-label-warning ms-1" style="font-size: 0.7rem;">TP</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $employee->position }}</td>
                                    <td><small>{{ $employee->email }}</small></td>
                                    <td><small>{{ $employee->phone }}</small></td>
                                    <td class="text-center">
                                        @php
                                            $hasActiveContract = $employee->contracts->where('status', 'active')->count() > 0;
                                        @endphp
                                        @if($hasActiveContract)
                                        <span class="badge bg-success">Đang làm</span>
                                        @else
                                        <span class="badge bg-secondary">Nghỉ việc</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('employees.show', $employee->employee_id) }}" class="btn btn-sm btn-icon btn-outline-primary" title="Xem chi tiết">
                                            <i class='bx bx-show'></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class='bx bx-user-x bx-lg text-muted mb-3'></i>
                        <p class="text-muted mb-0">Chưa có nhân viên nào trong phòng ban</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Thống kê theo chức vụ -->
            @if($department->employees->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class='bx bx-pie-chart-alt-2 me-2'></i>Thống kê theo chức vụ
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Gom nhóm theo position -> mỗi nhóm có [key][value] vd:  "Kỹ sư" => [A, B, C], "CEO" => [D, E] --}}
                         
                        @php
                           $positions = $department->employees->groupBy('position');
                        @endphp
                        @foreach($positions as $position => $employees)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="d-flex align-items-center p-3 border rounded">
                                <div class="avatar me-3">
                                    <span class="avatar-initial rounded-circle bg-label-info">
                                        <i class='bx bx-briefcase'></i>
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $position }}</h6>
                                    <small class="text-muted">{{ $employees->count() }} người</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection