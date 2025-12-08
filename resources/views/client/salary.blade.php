@extends('client')

@section('title', 'Chi tiết lương & Thưởng phạt')

@section('content')
<h5 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Trang chủ /</span> Lương & Thưởng phạt</h5>

<div class="row">
    <div class="col-md-12">
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-salary" aria-controls="navs-pills-top-salary" aria-selected="true">
                        <i class="bx bx-money me-1"></i> Danh sách lương
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-rewards" aria-controls="navs-pills-top-rewards" aria-selected="false">
                        <i class="bx bx-gift me-1"></i> Thưởng phạt
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <!-- Salary Tab -->
                <div class="tab-pane fade show active" id="navs-pills-top-salary" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tháng/Năm</th>
                                    <th>Ngày công</th>
                                    <th>Lương cơ bản</th>
                                    <th>Phụ cấp</th>
                                    <th>Thưởng</th>
                                    <th>Phạt</th>
                                    <th>Tổng nhận</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse($salary as $sal)
                                <tr>
                                    <td><strong>{{ $sal->month }}/{{ $sal->year }}</strong></td>
                                    <td>{{ $sal->work_day }}</td>
                                    <td>{{ number_format($sal->basic_salary) }} VNĐ</td>
                                    <td>{{ number_format($sal->allowance) }} VNĐ</td>
                                    <td class="text-success">+{{ number_format($sal->bonus) }} VNĐ</td>
                                    <td class="text-danger">-{{ number_format($sal->deduction) }} VNĐ</td>
                                    <td><strong class="text-primary">{{ number_format($sal->total_salary) }} VNĐ</strong></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Không có dữ liệu lương</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Rewards Tab -->
                <div class="tab-pane fade" id="navs-pills-top-rewards" role="tabpanel">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Ngày ghi nhận</th>
                                    <th>Loại</th>
                                    <th>Tiêu đề</th>
                                    <th>Số tiền</th>
                                    <th>Lý do</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse($rewards as $reward)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($reward->date_recorded)->format('d/m/Y') }}</td>
                                    <td>
                                        @if(strtolower($reward->type) == 'reward' || strtolower($reward->type) == 'khen thưởng')
                                            <span class="badge bg-label-success">Khen thưởng</span>
                                        @else
                                            <span class="badge bg-label-danger">Kỷ luật</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $reward->title }}</strong></td>
                                    <td>
                                        @if(strtolower($reward->type) == 'reward' || strtolower($reward->type) == 'khen thưởng')
                                            <span class="text-success">+{{ number_format($reward->amount) }} VNĐ</span>
                                        @else
                                            <span class="text-danger">-{{ number_format($reward->amount) }} VNĐ</span>
                                        @endif
                                    </td>
                                    <td>{{ $reward->description }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Không có dữ liệu thưởng phạt</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection