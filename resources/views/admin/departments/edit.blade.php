@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Sửa phòng ban</h5>
        <small class="text-muted float-end">Cập nhật thông tin phòng ban</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('departments.update', $department->department_id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Tên phòng ban</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $department->name) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="manager_id" class="form-label">Trưởng phòng</label>
                <select class="form-control" id="manager_id" name="manager_id">
                    <option value="">-- Chọn trưởng phòng --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->employee_id }}" 
                            {{ old('manager_id', $department->manager_id) == $employee->employee_id ? 'selected' : '' }}>
                            {{ $employee->full_name }} ({{ $employee->employee_id }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Có thể để trống nếu chưa có trưởng phòng</small>
            </div>

            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</div>

@endsection
