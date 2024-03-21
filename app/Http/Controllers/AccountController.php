<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        // Lấy danh sách tất cả các tài khoản từ cơ sở dữ liệu
        $accounts = Account::all();

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
        // Validate input
        $request->validate([
            'username' => 'required|unique:accounts',
            'fullname' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
        ]);

        try {
            // Create account
            Account::create([
                'username' => $request->input('username'),
                'fullname' => $request->input('fullname'),
                'age' => $request->input('age'),
                'address' => $request->input('address'),
            ]);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Tài khoản đã được tạo thành công!');
        } catch (\Exception $e) {
            // Redirect back with error message if any exception occurs
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
        ]);

        try {
            // Update account
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
}
