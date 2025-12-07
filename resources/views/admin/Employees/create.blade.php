@extends('admin')
@section('content')

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Thêm nhân viên</h5>
        <small class="text-muted float-end">Nhập thông tin nhân viên</small>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Form fields for employee details -->

            <!-- Thêm ảnh đại diện -->
            <div class="mb-3">
                <label for="img_link" class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control" id="img_link" name="img_link" accept="image/*" onchange="previewImage(event)">
                <div class="mt-2">
                    <img id="preview" src="" alt="Preview" style="max-width: 200px; max-height: 200px; display: none;" class="rounded">
                </div>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">Họ và tên</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Giới tính</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="M">Nam</option>
                    <option value="F">Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="department_id" class="form-label">Mã phòng ban</label>
                <select class="form-control" id="department_id" name="department_id">
                    <option value="">-- Chọn phòng ban --</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->department_id }}">{{ $department->name }} ({{ $department->department_id }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="hire_date" class="form-label">Ngày tuyển dụng</label>
                <input type="date" class="form-control" id="hire_date" name="hire_date" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Chức vụ</label>
                <input type="text" class="form-control" id="position" name="position" required>
            </div>
            <input type="checkbox" name="auto_createAC" id="auto_createAC" value="1">Tự động tạo tài khoản
            <div class="mb-3">
                
                <label for="user_id" class="form-label">Mã người dùng</label>
                <input type="text" class="form-control" id="user_id" name="user_id">
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>

</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script>

@endsection