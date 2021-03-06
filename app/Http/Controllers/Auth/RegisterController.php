<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support;\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest');
        $this->middlawere('user-should-verified');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min6',
            'g-recaptcha-response'=>'required|captcha',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $memberRole = Role::where('name','member')->first();
        $user->attachRole($memberRole);
        $user->sendVerification();
        return $user;
            }
             public function verify(Request $request,$token)
             {
                $email = $request->get('email');
                $user = $User::where('verification_token', $token)->where('email',$email)->first();
                if($user) {
                    $user->verify();
                    Session::flash("flash_notification",[
                        "level"=>"success",
                        "message"=>"berhasil melakukan verifikasi."]);
                    AUth::login($user);
                }
                return redirect('/');
             }
}
