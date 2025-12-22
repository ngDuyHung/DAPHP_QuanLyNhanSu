@extends('admin')
@section('content')

<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Quản lý /</span> Nghỉ phép</h4>
            <small class="text-muted">Theo dõi và phê duyệt đơn nghỉ phép nhân viên</small>
        </div>
        <a href="{{ route('leaves.create') }}" class="btn btn-primary shadow-sm">
            <i class='bx bx-plus me-1'></i> Tạo đơn mới
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-white border-bottom">
            <ul class="nav nav-tabs card-header-tabs" id="viewTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active d-flex align-items-center" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar-view" type="button" role="tab">
                        <i class='bx bx-calendar me-2'></i> Xem lịch biểu
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link d-flex align-items-center" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-view" type="button" role="tab">
                        <i class='bx bx-list-ul me-2'></i> Danh sách đơn
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="viewTabsContent">
            <div class="tab-pane fade show active" id="calendar-view" role="tabpanel">
                <div class="p-4">
                    <div id='calendar'></div>
                </div>
            </div>

            <div class="tab-pane fade" id="list-view" role="tabpanel">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Nhân viên</th>
                                <th>Loại phép</th>
                                <th>Thời gian</th>
                                <th class="text-center">Số ngày</th>
                                <th>Trạng thái</th>
                                <th class="text-center pe-4">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaves as $leave)
                            @php
                            $startDate = \Carbon\Carbon::parse($leave->start_date);
                            $endDate = \Carbon\Carbon::parse($leave->end_date);
                            $daysDiff = $startDate->diffInDays($endDate) + 1;
                            $statusConfig = [
                            'approved' => ['badge' => 'bg-label-success', 'text' => 'Đã duyệt', 'icon' => 'bx-check-circle'],
                            'pending' => ['badge' => 'bg-label-warning', 'text' => 'Chờ duyệt', 'icon' => 'bx-time-five'],
                            'rejected' => ['badge' => 'bg-label-danger', 'text' => 'Từ chối', 'icon' => 'bx-x-circle'],
                            ];
                            $status = $statusConfig[$leave->status] ?? $statusConfig['pending'];
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    @if($leave->employee)
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="avatar-wrapper me-3">
                                            @if($leave->employee->img_link)
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('storage/' . $leave->employee->img_link) }}" alt="Avatar" class="rounded-circle">
                                            </div>
                                            @else
                                            <div class="avatar avatar-sm">
                                                <span class="avatar-initial rounded-circle bg-label-primary">
                                                    {{ strtoupper(substr($leave->employee->full_name, 0, 1)) }}
                                                </span>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="text-heading text-truncate fw-semibold mb-0">
                                                {{ $leave->employee->full_name }}
                                            </span>
                                            <small class="text-muted">{{ $leave->employee->department->name ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                    @else
                                    <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-label-info">{{ $leave->leave_type }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted">Từ: <span class="fw-semibold text-dark">{{ $startDate->format('d/m/Y') }}</span></small>
                                        <small class="text-muted">Đến: <span class="fw-semibold text-dark">{{ $endDate->format('d/m/Y') }}</span></small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class='bx bx-calendar me-1 text-primary'></i>
                                        <span class="fw-bold">{{ $daysDiff }}</span>
                                        <small class="text-muted ms-1">ngày</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge {{ $status['badge'] }}">
                                        <i class='bx {{ $status['icon'] }} me-1'></i>{{ $status['text'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        
                                        <a href="{{ route('leaves.edit', $leave->leave_id) }}" class="btn btn-outline-warning btn-sm"> <i class='bx bx-edit-alt'></i>Chỉnh sửa</a>
                                        <form action="{{ route('leaves.destroy', $leave->leave_id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-outline-danger btn-sm" title="Xóa đơn" onclick="return confirm('Xóa đơn nghỉ phép này?')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="eventModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Chi tiết đơn nghỉ phép</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12 border-bottom pb-2 mb-2">
                        <label class="text-muted small d-block">Nhân viên</label>
                        <span class="fw-bold fs-5 text-primary" id="mEmployee"></span>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block">Loại hình</label>
                        <span class="badge bg-label-info" id="mType"></span>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <label class="text-muted small d-block">Trạng thái</label>
                        <div id="mStatusBadge"></div>
                    </div>

                    <div class="col-12 py-2 bg-light rounded d-flex justify-content-around text-center mt-3">
                        <div>
                            <small class="text-muted d-block">Bắt đầu</small>
                            <span class="fw-semibold" id="mStart"></span>
                        </div>
                        <div class="align-self-center text-muted"><i class='bx bx-right-arrow-alt'></i></div>
                        <div>
                            <small class="text-muted d-block">Kết thúc</small>
                            <span class="fw-semibold" id="mEnd"></span>
                        </div>
                        <div class="border-start ps-3">
                            <small class="text-muted d-block">Tổng ngày</small>
                            <span class="fw-bold text-primary" id="mDays"></span>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <label class="text-muted small d-block mb-1">Lý do nghỉ</label>
                        <div class="p-2 border rounded bg-white small" id="mReason" style="min-height: 60px;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top bg-light p-2 d-flex justify-content-between">
                <form id="mDeleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm border-0" onclick="return confirm('Xóa đơn này?')">
                        <i class="bx bx-trash me-1"></i> Xóa đơn
                    </button>
                </form>
                <div>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Đóng</button>
                    <a id="mEditLink" href="#" class="btn btn-primary btn-sm">
                        <i class="bx bx-edit-alt me-1"></i> Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'vi',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listMonth'
            },
            events: [
                @foreach($leaves as $leave)
                @php
                $d = \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1;
                @endphp {
                    id: '{{ $leave->leave_id }}',
                    title: '{{ $leave->employee->full_name ?? "N/A" }}',
                    start: '{{ $leave->start_date }}',
                    end: '{{ \Carbon\Carbon::parse($leave->end_date)->addDay()->format("Y-m-d") }}',
                    backgroundColor: '{{ $leave->status == "approved" ? "#e8fadf" : ($leave->status == "pending" ? "#fff2e0" : "#ffe5e5") }}',
                    borderColor: '{{ $leave->status == "approved" ? "#71dd37" : ($leave->status == "pending" ? "#ffab00" : "#ff3e1d") }}',
                    textColor: '{{ $leave->status == "approved" ? "#71dd37" : ($leave->status == "pending" ? "#ffab00" : "#ff3e1d") }}',
                    extendedProps: {
                        type: '{{ $leave->leave_type }}',
                        reason: '{{ $leave->reason ?? "Không có lý do kèm theo." }}',
                        days: '{{ $d }} ngày',
                        statusText: '{{ $leave->status == "approved" ? "Đã duyệt" : ($leave->status == "pending" ? "Chờ duyệt" : "Từ chối") }}',
                        statusClass: '{{ $leave->status == "approved" ? "bg-label-success" : ($leave->status == "pending" ? "bg-label-warning" : "bg-label-danger") }}',
                        sDate: '{{ \Carbon\Carbon::parse($leave->start_date)->format("d/m/Y") }}',
                        eDate: '{{ \Carbon\Carbon::parse($leave->end_date)->format("d/m/Y") }}',
                        editUrl: '{{ route("leaves.edit", $leave->leave_id) }}',
                        deleteUrl: '{{ route("leaves.destroy", $leave->leave_id) }}'
                    }
                },
                @endforeach
            ],
            eventClick: function(info) {
                let p = info.event.extendedProps;
                document.getElementById('mEmployee').innerText = info.event.title;
                document.getElementById('mType').innerText = p.type;
                document.getElementById('mStart').innerText = p.sDate;
                document.getElementById('mEnd').innerText = p.eDate;
                document.getElementById('mReason').innerText = p.reason;
                document.getElementById('mDays').innerText = p.days;
                document.getElementById('mStatusBadge').innerHTML = `<span class="badge ${p.statusClass}">${p.statusText}</span>`;
                document.getElementById('mEditLink').href = p.editUrl;
                document.getElementById('mDeleteForm').action = p.deleteUrl;
                eventModal.show();
            }
        });

        calendar.render();

        // Re-render khi chuyển tab để fix lỗi kích thước
        document.getElementById('calendar-tab').addEventListener('shown.bs.tab', function() {
            calendar.render();
        });
    });
</script>

<style>
    
    /* Chỉnh sửa Calendar */
    .fc-event {
        cursor: pointer;
        border-width: 0 0 0 3px !important;
    }

    .fc-toolbar-title {
        font-size: 1.2rem !important;
    }

    /* Chỉnh sửa Table */
    .btn-icon:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .nav-tabs .nav-link.active {
        border-bottom: 2px solid #696cff !important;
        color: #696cff !important;
        font-weight: 600;
    }

    /* Badge styling */
    .bg-label-info {
        background: #e1f0ff;
        color: #03c3ec;
    }

    .bg-label-success {
        background: #e8fadf;
        color: #71dd37;
    }

    .bg-label-warning {
        background: #fff2e0;
        color: #ffab00;
    }

    .bg-label-danger {
        background: #ffe5e5;
        color: #ff3e1d;
    }
</style>

@endsection