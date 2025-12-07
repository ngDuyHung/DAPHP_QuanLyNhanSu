@extends('admin')
@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="container-fluid mt-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="m-0">Quản lý tài khoản</h4>

                <a class="btn btn-primary" href="{{ route('accounts.create') }}">
                    Thêm tài khoản
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>Nhân viên liên kết</th>
                    <th>Ngày tạo</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($accounts as $account)
                <tr>
                    <td>{{ $account->id }}</td>
                    <td>
                        <strong>{{ $account->name }}</strong>
                    </td>
                    <td>
                        <i class="bx bx-envelope"></i> {{ $account->email }}
                    </td>
                    <td>
                        @if($account->employee)
                            @include('layouts.admin.userInfo', ['employee' => $account->employee])
                        @else
                            <span class="badge bg-warning">Chưa liên kết</span>
                        @endif
                    </td>
                    <td>
                        @if($account->created_at)
                            {{ $account->created_at->format('d/m/Y H:i') }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        @if($account->role=='admin')
                            <span class="badge bg-success">
                                <i class="bx bx-shield-quarter"></i> Quản trị viên
                            </span>
                        @elseif($account->role=='hr')
                            <span class="badge bg-info">
                                <i class="bx bx-user"></i> Nhân sự
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                <i class="bx bx-user"></i> Nhân viên
                            </span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-sm btn-outline-warning"><i class="fa-regular fa-pen-to-square"></i> Sửa</a>
                        <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?')"><i class="fa-regular fa-trash-can"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--/ Basic Bootstrap Table -->


@endsection
