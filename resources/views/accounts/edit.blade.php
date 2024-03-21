@extends('layouts.header')

@section('title', 'Chỉnh sửa tài khoản')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Chỉnh sửa tài khoản</h2>

            <form action="{{ route('accounts.update', $account->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" value="{{ $account->username }}" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="fullname" value="{{ $account->fullname }}" placeholder="Fullname" required>
                </div>
                <div class="mb-3">
                    <input type="number" class="form-control" name="age" value="{{ $account->age }}" max="100" min="1" placeholder="Age" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="address" value="{{ $account->address }}" placeholder="Address" required>
                </div>
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
            </form>
        </div>
    </div>
</div>

@extends('layouts.footer')
