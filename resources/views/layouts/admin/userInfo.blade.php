<div class="d-flex justify-content-start align-items-center user-name">
    <div class="avatar-wrapper">
        @if($employee->img_link)
        <div class="avatar avatar-sm me-4"><img src="{{ asset('storage/' . $employee->img_link) }}" alt="Avatar" class="rounded-circle"></div>
        @else
        <div class="avatar avatar-sm me-4">
            <span class="avatar-initial rounded-circle bg-label-primary">
                {{ strtoupper(substr($employee->full_name, 0, 1)) }}
            </span>
        </div>
        @endif
    </div>
    <div class="d-flex flex-column"><a href="{{ route('employees.show', $employee->employee_id) }}" class="text-heading text-truncate"><span class="fw-medium">{{ $employee->full_name }}</span></a><small>{{ $employee->email }}</small></div>
</div>