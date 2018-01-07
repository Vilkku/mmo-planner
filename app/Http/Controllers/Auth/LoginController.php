<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BattleNet;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        die('foo');
        return BattleNet::redirect('eu');
    }

    public function return()
    {
        $errors = array();
        $info = Socialite::driver('battlenet')->user();

        var_dump($info);
        die();

        if (!is_null($info)) {
            $user = User::where('bnetid', $info->getId())->first();

            if (Auth::check()) {
                if (is_null($user)) {
                    $user = Auth::user();
                    $user->bnetid = $info->getId();
                    $user->name = $info->getNickname();
                    $user->save();
                    $errors['login'] = 'Battle.net account successfully linked';
                } else {
                    $errors['login'] = 'Battle.net account already linked to an existing account!';
                }
            } else {
                if (is_null($user)) {
                    $battletag = $info->getNickname();
                    $battletag_parts = explode('#', $battletag);
                    $user = User::create([
                        'name' => $battletag_parts[0],
                        'bnetid' => $info->getId(),
                        'battletag' => $battletag
                    ]);

                    $errors['login'] = 'Registered successfully';
                } else {
                    $errors['login'] = 'Logged in successfully';
                }

                $user->js_token = uniqid();
                $user->save();

                Auth::login($user, true);
            }
        }

        return redirect()->intended('/')->withErrors($errors);;
    }
}
