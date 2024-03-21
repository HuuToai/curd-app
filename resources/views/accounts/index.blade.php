@extends('layouts.header')

@section('title', 'Danh sách tài khoản')

<h1>Danh sách tài khoản</h1>
<a class="btn btn-outline-primary" href="{{ route('accounts.create') }}">Thêm Tài Khoản Mới</a>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Username</th>
        <th scope="col">Fullname</th>
        <th scope="col">Age</th>
        <th scope="col">Address</th>
    </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($accounts as $account)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $account->username }}</td>
                <td>{{ $account->fullname }}</td>
                <td>{{ $account->age }}</td>
                <td>{{ $account->address }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@extends('layouts.footer')
