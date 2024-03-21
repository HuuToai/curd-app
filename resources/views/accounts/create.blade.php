<!-- resources/views/accounts/create.blade.php -->
@extends('layouts.header')

@section('title', 'Thêm mới tài khoản')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <h2 >Thêm mới tài khoản</h2>

            <form action="{{ route('accounts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="fullname" placeholder="Fullname">
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="age" placeholder="Age">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="address" placeholder="Address">
                </div>
                <button type="submit" class="btn btn-primary">Thêm Tài Khoản</button>
            </form>
        </div>
    </div>
</div>
@extends('layouts.footer')