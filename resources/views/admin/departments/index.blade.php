@extends('admin')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                <i class='bx bx-buildings me-2'></i>Quản lý phòng ban
            </h4>
            <p class="text-muted mb-0">Tổng cộng: <strong>{{ $departments->count() }}</strong> phòng ban</p>
        </div>
        <a class="btn btn-primary" href="{{ route('departments.create') }}">
            <i class='bx bx-plus me-1'></i>Thêm phòng ban
        </a>
    </div>

    <!-- Departments Grid -->
    <div class="row g-4">
        @forelse($departments as $department)
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100 department-card">
                <div class="card-body">
                    <!-- Header với icon và actions -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg me-3">
                                <span class="avatar-initial rounded-circle bg-label-primary">
                                    <i class='bx bx-buildings bx-sm'></i>
                                </span>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $department->name }}</h5>
                                <small class="text-muted">ID: {{ $department->department_id }}</small>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                <i class='bx bx-dots-vertical-rounded'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('departments.show', $department->department_id) }}">
                                        <i class='bx bx-show me-2'></i>Xem chi tiết
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('departments.edit', $department->department_id) }}">
                                        <i class='bx bx-edit me-2'></i>Chỉnh sửa
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('departments.destroy', $department->department_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa phòng ban này không?')">
                                            <i class='bx bx-trash me-2'></i>Xóa
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Trưởng phòng -->
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block mb-2">
                            <i class='bx bx-user-circle me-1'></i>Trưởng phòng
                        </small>
                        @if($department->manager)
                        <div class="d-flex align-items-center">
                            @if($department->manager->img_link)
                            <img src="{{ asset('storage/' . $department->manager->img_link) }}" alt="Avatar" class="rounded-circle me-2" style="width: 32px; height: 32px; object-fit: cover;">
                            @else
                            <div class="avatar avatar-sm me-2">
                                <span class="avatar-initial rounded-circle bg-label-success">
                                    {{ strtoupper(substr($department->manager->full_name, 0, 1)) }}
                                </span>
                            </div>
                            @endif
                            <div>
                                <div class="fw-medium">{{ $department->manager->full_name }}</div>
                                <small class="text-muted">{{ $department->manager->position }}</small>
                            </div>
                        </div>
                        @else
                        <div class="text-center py-2">
                            <i class='bx bx-user-x text-muted'></i>
                            <small class="text-muted d-block">Chưa có trưởng phòng</small>
                        </div>
                        @endif
                    </div>

                    <!-- Thống kê -->
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-2">
                                    <span class="avatar-initial rounded bg-label-info">
                                        <i class='bx bx-group'></i>
                                    </span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Nhân viên</small>
                                    <h6 class="mb-0">{{ $department->employees->count() }}</h6>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-2">
                                    <span class="avatar-initial rounded bg-label-success">
                                        <i class='bx bx-check-circle'></i>
                                    </span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Hoạt động</small>
                                    <h6 class="mb-0">
                                        @php
                                            $activeCount = $department->employees->filter(function($emp) {
                                                return $emp->contracts->where('status', 'active')->count() > 0;
                                            })->count();
                                        @endphp
                                        {{ $activeCount }}
                                    </h6>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm me-2">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class='bx bx-edit'></i>
                                    </span>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Hành động</small>
                                    <h6 class="mb-0">
                                   <a href="{{ route('departments.edit', $department->department_id) }}">Chỉnh sửa</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Progress bar nhân viên -->
                    <!-- @if($department->employees->count() > 0)
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted">Tỷ lệ nhân viên đang làm</small>
                            <small class="fw-medium">{{ $activeCount }}/{{ $department->employees->count() }}</small>
                        </div>
                        <div class="progress" style="height: 6px;">
                            @php
                                $percentage = $department->employees->count() > 0 ? ($activeCount / $department->employees->count() * 100) : 0;
                            @endphp
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>
                    @endif -->

                    <!-- Action button -->
                    <a href="{{ route('departments.show', $department->department_id) }}" class="btn btn-outline-primary w-100">
                        <i class='bx bx-show me-1'></i>Xem chi tiết
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class='bx bx-buildings bx-lg text-muted mb-3'></i>
                    <h5>Chưa có phòng ban nào</h5>
                    <p class="text-muted">Hãy thêm phòng ban đầu tiên</p>
                    <a href="{{ route('departments.create') }}" class="btn btn-primary">
                        <i class='bx bx-plus me-1'></i>Thêm phòng ban
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>

<style>
    .department-card {
        transition: all 0.3s ease;
        border: 1px solid #e7e7e7;
    }

    .department-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        border-color: #696cff;
    }

    .department-card .card-body {
        position: relative;
    }

    .department-card .dropdown-menu {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
</style>

@endsection