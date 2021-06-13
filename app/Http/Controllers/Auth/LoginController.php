<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Socialite;
use Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //Google認証 追記
    public function redirectToGoogle()
    {
        Log::debug('1');
        //Googleへリダイレクト
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Google認証後の処理
        Log::debug('2');
        $googleUser = Socialite::driver('google')->stateless()->user();
        Log::debug(print_r($googleUser, true));
        Log::debug('3');

        // email が合致するユーザーを取得
        $user = User::where('email', $googleUser->email)->first();

        // 見つからなければ新しくユーザーを作成
        if ($user == null) {
            $user = $this->createUserByGoogle($googleUser);
        }

        // ログイン処理
        \Auth::login($user, true);
        return redirect()->route('room.top');
    }

    public function createUserByGoogle($googleUser)
    {
        $user = User::create([
            'name'     => $googleUser->name,
            'email'    => $googleUser->email,
            'password' => \Hash::make(uniqid()),
        ]);
        return $user;
    }
}
