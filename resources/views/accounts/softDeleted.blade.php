@extends('layouts.header')

@section('title', 'Danh sách các tài khoản đã xóa mềm')

<h1>Danh sách các tài khoản đã xóa mềm</h1>
<a class="btn btn-outline-primary" href="{{ route('accounts.index') }}">Quay lại</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">Fullname</th>
            <th scope="col">Age</th>
            <th scope="col">Address</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($softDeletedAccounts as $account)
        <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $account->username }}</td>
            <td>{{ $account->fullname }}</td>
            <td>{{ $account->age }}</td>
            <td>{{ $account->address }}</td>
            <td>
                <form action="{{ route('accounts.restore', $account->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PUT') <!-- Hoặc sử dụng POST -->
                    <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Bạn có chắc chắn muốn phục hồi tài khoản này?')">Phục hồi</button>
                </form>
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@extends('layouts.footer')
