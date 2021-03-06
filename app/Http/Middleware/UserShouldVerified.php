<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserShouldVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (Auth::check() && !Auth::use()->is_verifeid) {
            Auth::logout();

            session::flash("flash_notification", ["level" => "warning", "message" => "Akun anda belum aktif. Silahkan klik pada link aktivasi yang telah kami kirim."]);
            return redirect('/login');
        }
        return $response;
    }
}
