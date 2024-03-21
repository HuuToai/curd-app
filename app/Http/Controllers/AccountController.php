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
}
