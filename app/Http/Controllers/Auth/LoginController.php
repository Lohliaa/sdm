<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Ke mana user diarahkan setelah login berhasil.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Konstruktor.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
 
    /**
     * Menangani jika login gagal.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Email atau password salah.');
    }

} 
