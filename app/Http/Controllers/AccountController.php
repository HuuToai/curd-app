<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Exceptions\PostTooLargeException;

class AccountController extends Controller
{
    public function index()
    {
        // Lấy danh sách tất cả các tài khoản từ cơ sở dữ liệu với phân trang
        $accounts = Account::paginate(2); // Số lượng tài khoản trên mỗi trang là 10, bạn có thể thay đổi tùy ý

        // Trả về view 'accounts.index' và truyền biến $accounts vào view
        return view('accounts.index', compact('accounts'));
    }

    public function create()
    {
        // Trả về view 'accounts.create'
        return view('accounts.create');
    }


    public function store(Request $request)
    {
        try {
            // Validate input
            $request->validate([
                'username' => 'required|unique:accounts',
                'fullname' => 'required',
                'age' => 'required|numeric',
                'address' => 'required',
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:1048576', // Ảnh phải là hình ảnh và dung lượng không quá 2MB
            ]);
        } catch (PostTooLargeException $e) {
            // Xử lý ngoại lệ nếu tệp vượt quá dung lượng cho phép
            return redirect()->back()->withErrors(['error' => 'Tệp ảnh quá lớn. Vui lòng chọn một tệp nhỏ hơn.']);
        }

        try {
            // Kiểm tra xem tệp đã được tải lên chưa
            if ($request->hasFile('avatar')) {
                // Xử lý tệp ảnh
                $avatarName = time() . '.' . $request->file('avatar')->extension();
                $request->file('avatar')->move(public_path('storage/avatars'), $avatarName);

                // Tạo tài khoản với đường dẫn ảnh
                Account::create([
                    'username' => $request->input('username'),
                    'fullname' => $request->input('fullname'),
                    'age' => $request->input('age'),
                    'address' => $request->input('address'),
                    'avatar' => '/storage/avatars/' . $avatarName, // Lưu đường dẫn của ảnh
                ]);
            }

            // Redirect back with success message
            return redirect()->back()->with('success', 'Tài khoản đã được tạo thành công!');
        } catch (\Exception $e) {
            // Redirect back with error message if any other exception occurs
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra. Vui lòng thử lại sau.']);
        }
    }


    public function destroy($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy tài khoản']);
        }
        $account->delete();
        return redirect()->back()->with('success', 'Tài khoản đã được xóa thành công!');
    }
    public function edit(Account $account)
    {
        return view('accounts.edit', compact('account'));
    }

    public function update(Request $request, Account $account)
    {
        // Validate input
        $request->validate([
            'username' => 'required|unique:accounts,username,' . $account->id,
            'fullname' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra ảnh nếu có
        ]);

        try {
            // Nếu người dùng tải lên ảnh mới
            if ($request->hasFile('avatar')) {
                // Xử lý tệp ảnh
                $avatarName = time() . '.' . $request->file('avatar')->extension();
                $request->file('avatar')->move(public_path('storage/avatars'), $avatarName);

                // Cập nhật đường dẫn ảnh trong cơ sở dữ liệu
                $account->update(['avatar' => '/storage/avatars/' . $avatarName]);
            }

            // Cập nhật thông tin tài khoản
            $account->update([
                'username' => $request->input('username'),
                'fullname' => $request->input('fullname'),
                'age' => $request->input('age'),
                'address' => $request->input('address'),
            ]);

            // Redirect back with success message
            return redirect()->route('accounts.index')->with('success', 'Tài khoản đã được cập nhật thành công!');
        } catch (\Exception $e) {
            // Redirect back with error message if any exception occurs
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra. Vui lòng thử lại sau.']);
        }
    }


    public function softDelete($id)
    {

        // Tìm tài khoản cần xóa
        $account = Account::find($id);

        // Kiểm tra nếu không tìm thấy
        if (!$account) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy tài khoản']);
        }

        try {
            // Xóa mềm tài khoản
            DB::transaction(function () use ($account) {
                $account->delete();
            });

            // Redirect về danh sách tài khoản với thông báo thành công
            return redirect()->route('accounts.index')->with('success', 'Tài khoản đã được xóa mềm thành công!');
        } catch (\Exception $e) {
            // Redirect về trang trước với thông báo lỗi nếu có lỗi xảy ra
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra. Vui lòng thử lại sau.']);
        }
    }
    public function softDeleted()
    {
        // Lấy danh sách các tài khoản đã bị xóa mềm từ cơ sở dữ liệu
        $softDeletedAccounts = Account::onlyTrashed()->get();

        // Trả về view 'accounts.softDeleted' và truyền biến $softDeletedAccounts vào view
        return view('accounts.softDeleted', compact('softDeletedAccounts'));
    }
    public function restore(Request $request, $id)
    {
        try {
            // Tìm tài khoản cần phục hồi trong cơ sở dữ liệu
            $account = Account::withTrashed()->find($id);

            // Kiểm tra nếu không tìm thấy tài khoản
            if (!$account) {
                return redirect()->back()->withErrors(['error' => 'Không tìm thấy tài khoản đã xóa mềm']);
            }

            // Phục hồi tài khoản đã xóa mềm
            $account->restore();

            // Redirect về trang danh sách tài khoản với thông báo thành công
            return redirect()->route('accounts.index')->with('success', 'Tài khoản đã được phục hồi thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi, redirect về trang trước với thông báo lỗi
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra. Vui lòng thử lại sau.']);
        }
    }
}
