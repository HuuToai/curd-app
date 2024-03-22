@extends('layouts.header')

@section('title', 'Danh sách tài khoản')

<h1>Danh sách tài khoản</h1>
<a class="btn btn-outline-primary" href="{{ route('accounts.create') }}">Thêm Tài Khoản Mới</a>
<a class="btn btn-outline-primary" href="{{ route('accounts.softDeleted') }}">Khôi phục đã xóa</a>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Avatar</th>
        <th scope="col">Username</th>
        <th scope="col">Fullname</th>
        <th scope="col">Age</th>
        <th scope="col">Address</th>
        <th scope="col">Options</th>
    </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($accounts as $account)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>
                    <!-- Hiển thị ảnh -->
                    <img src="{{ asset($account->avatar) }}" alt="Avatar" style="max-width: 100px;">
                </td>
                <td>{{ $account->username }}</td>
                <td>{{ $account->fullname }}</td>
                <td>{{ $account->age }}</td>
                <td>{{ $account->address }}</td>
                <td>
                    <a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                    <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">Xóa</button>
                    </form>
                    <form action="{{ route('accounts.softDelete', $account->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-warning" onclick="return confirm('Bạn có chắc chắn muốn xóa mềm tài khoản này?')">
                            <i class="fas fa-trash"></i> Xóa Mềm
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
  </table>
  {{ $accounts->links() }}
@extends('layouts.footer')
