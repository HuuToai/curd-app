@extends('layouts.header')

@section('title', 'Thêm mới tài khoản')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Thêm mới tài khoản</h2>

            <form action="{{ route('accounts.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="fullname" placeholder="Fullname" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="age" max="100" min="1" placeholder="Age" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                </div>
                <button type="submit" class="btn btn-primary">Thêm Tài Khoản</button>
            </form>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">danh sách tài khoản</a>
        </div>
    </div>
</div>

@extends('layouts.footer')
