<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest; // StoreUserRequest をインポート
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
// ユーザー登録フォームを表示
public function create()
{
return view('auth.register');
}

        // ユーザー登録処理
        // 例: RegisteredUserController の store メソッド

        public function store(Request $request)
        {
                // 会員登録処理
                $validated = $request->validate([
                        'name' => 'required|string|max:255',
                        'email' => 'required|string|email|max:255|unique:users',
                        'password' => 'required|string|min:8',
                ]);

                $user = User::create([
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'password' => Hash::make($validated['password']),
                ]);

                // ログイン処理
                auth()->login($user);

                // 体重目標登録画面にリダイレクト
                return redirect()->route('weight_target.create');
        }

}