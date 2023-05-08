<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    use AuthTrait;

    public function __construct()
    {
//        $this->middleware('web')->except('logout');
    }


    public function loginForm($type){

        return view('auth.login',compact('type'));
    }

    public function login(Request $request){

        if (Auth::guard($this->chekGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }
        else{
            return redirect()->back()->with('error', 'يوجد خطا في كلمة المرور او اسم المستخدم');
        }

    }

    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
