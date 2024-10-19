<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
        public function showLoginForm()
        {
            return view('auth.login'); // Trả về view đăng nhập
        }
    
        public function login(Request $request)
        {
            $credentials = $request->only('username', 'password');
    
            if (Auth::attempt($credentials)) {
                // Đăng nhập thành công, chuyển hướng đến trang chủ
                return redirect()->intended('/home');
            }
    
            // Đăng nhập thất bại, quay lại trang login kèm thông báo lỗi
            return back()->withErrors([
                'username' => 'Sai tên đăng nhập hoặc mật khẩu.',
            ])->withInput($request->except('password'));
        }
    }
