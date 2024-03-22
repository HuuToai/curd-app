@extends('layouts.header')

@section('title', 'Chỉnh sửa tài khoản')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Chỉnh sửa tài khoản</h2>

            <form action="{{ route('accounts.update', $account->id) }}" method="POST" enctype="multipart/form-data">
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
                {{-- <div class="mb-3">
                    <label for="avatar" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="avatar" id="avatar">
                    <img src="{{ asset($account->avatar) }}" alt="Avatar" style="max-width: 100px;">
                </div> --}}

                <div class="mb-3">
                    <label for="avatar" class="form-label">Ảnh</label>
                    <input type="file" class="form-control" name="avatar" id="avatar">
                    <small class="text-muted">Ảnh phải có kích thước nhỏ hơn 2MB</small>
                    @error('avatar')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <img src="{{ asset($account->avatar) }}" alt="Avatar" style="max-width: 100px;">
                </div>
                <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
            </form>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">danh sách tài khoản</a>

        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('form').addEventListener('submit', function(event) {
            var avatarInput = document.querySelector('#avatar');
            if (avatarInput.files.length > 0) {
                var fileSize = avatarInput.files[0].size; // Kích thước của tệp ảnh
                var maxSize = 2 * 1024 * 1024; // Kích thước tối đa là 2MB
                if (fileSize > maxSize) {
                    event.preventDefault(); // Ngăn chặn form được gửi đi
                    alert('Kích thước của ảnh vượt quá 2MB. Vui lòng chọn ảnh có kích thước nhỏ hơn.');
                }
            }
        });
    });
</script>

@extends('layouts.footer')
