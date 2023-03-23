<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function signIn()
    {
        return view('user.signin');
    }

    public function signUp()
    {
        return view('user.signup');
    }

    public function auth(AuthRequest $request)
    {
        $credentials = ['email' => $request->email,'password' => $request->password];
        if(Auth::attempt($credentials)){
            $user = User::select('*')->where(['email'=>$request->email])->first();
            session()->put(['name'=>$user->name,'email'=>$user->email]);
            return to_route('signin')->with('success', 'Usuário autenticado com sucesso.');
        }
        return to_route('signin')->with('error','Falha ao autenticar usuário.');
    }

    public function create(UserRequest $request)
    {
        $data = $request->except(['_token', 'ccpassword']);
        $data['password'] = bcrypt($data['cpassword']);
        $user = User::create($data);
        if ($user) {
            return to_route('signin')->with('success', 'Usuário cadastrado com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Falha ao realizar cadastro.');
        }
    }
}
