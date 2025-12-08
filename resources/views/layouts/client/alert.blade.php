@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border border-success" role="alert">
    <div class="d-flex align-items-center">
        <i class="bx bx-check-circle fs-4 me-2"></i>
        <div class="flex-grow-1">
            <strong>Thành công!</strong> {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show border border-danger" role="alert">
    <div class="d-flex align-items-center">
        <i class="bx bx-error-circle fs-4 me-2"></i>
        <div class="flex-grow-1">
            <strong>Lỗi!</strong> {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show border border-warning" role="alert">
    <div class="d-flex align-items-center">
        <i class="bx bx-error fs-4 me-2"></i>
        <div class="flex-grow-1">
            <strong>Cảnh báo!</strong> {{ session('warning') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('info'))
<div class="alert alert-info alert-dismissible fade show border border-info" role="alert">
    <div class="d-flex align-items-center">
        <i class="bx bx-info-circle fs-4 me-2"></i>
        <div class="flex-grow-1">
            <strong>Thông tin!</strong> {{ session('info') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show border border-danger" role="alert">
    <div class="d-flex align-items-start">
        <i class="bx bx-error-circle fs-4 me-2 mt-1"></i>
        <div class="flex-grow-1">
            <strong>Có lỗi xảy ra!</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif