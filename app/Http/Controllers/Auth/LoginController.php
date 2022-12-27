<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  public function create()
  {
    return view('auth.login');
  }

  public function store(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'string', 'email'],
      'password' => ['required', 'string'],
    ]);

    if (!Auth::attempt($credentials)) {

      //----------> BU 2-USUL
      throw ValidationException::withMessages([
        'email' => 'These credentials do not match our records.'
      ]);

      // //-----------> BU 1-USUL
      // return back()
      //   ->withInput()
      //   ->withErrors([
      //     'email' => 'These credentials do not match our records.'
      //   ]);
    }

    return redirect()->intended(RouteServiceProvider::HOME);
  }
}
