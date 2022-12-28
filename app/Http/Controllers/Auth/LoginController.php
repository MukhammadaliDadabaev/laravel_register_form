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

    if (!Auth::attempt($credentials, $request->boolean('remember'))) {

      //----------> BU 2-USUL
      throw ValidationException::withMessages([
        'email' => trans('auth.failed')
      ]);

      // //-----------> BU 1-USUL
      // return back()
      //   ->withInput()
      //   ->withErrors([
      //     'email' => 'These credentials do not match our records.'
      //   ]);
    }

    $request->session->regenerate();

    return redirect()->intended(RouteServiceProvider::HOME);
  }

  public function destroy(Request $request)
  {
    Auth::logout();

    $request->session->invalidate();
    $request->session->regenerateToken();

    return redirect()->route('welcome');
  }
}
