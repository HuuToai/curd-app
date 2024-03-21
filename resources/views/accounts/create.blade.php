<!-- resources/views/accounts/create.blade.php -->
@extends('layouts.header')

@section('title', 'Thêm mới tài khoản')

<form action="{{ route('accounts.store') }}" method="POST">
    @csrf
    <input type="text" name="username" placeholder="Username">
    <input type="text" name="fullname" placeholder="Fullname">
    <input type="number" name="age" placeholder="Age">
    <input type="text" name="address" placeholder="Address">
    <button type="submit">Thêm Tài Khoản</button>
</form>

@extends('layouts.footer')