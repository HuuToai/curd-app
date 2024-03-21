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
}
