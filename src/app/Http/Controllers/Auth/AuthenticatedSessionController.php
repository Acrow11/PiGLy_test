<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    // ログインフォーム表示
    public function create()
    {
        return view('auth.login');
    }

    // ログイン処理
    public function store(Request $request)
    {
        // 入力のバリデーション
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ログイン試行
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ログイン後、体重ログ一覧へリダイレクト
            return redirect()->intended('/weight_logs');
        }

        // 認証失敗時
        throw ValidationException::withMessages([
            'email' => 'メールアドレスまたはパスワードが間違っています。',
        ]);
    }

    // ログアウト処理
    public function destroy(Request $request)
    {
        Auth::logout();

        // セッションを破棄し、ログインページにリダイレクト
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
