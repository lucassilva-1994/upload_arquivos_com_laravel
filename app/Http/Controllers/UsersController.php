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
            $user->increment('qtd_access',1);
            session()->put([
                'id_user'=> $user->id,
                'name'=>$user->name,
                'email'=>$user->email
            ]);
            return to_route('file.all');
        }
        return to_route('signin')->with('error','Falha ao autenticar usuário.');
    }

    public function create(UserRequest $request)
    {
        return User::userCreate($request->except(['_token', 'ccpassword']));
    }

    public function signOut(){
        session()->forget(['id_user','name','email']);
        return to_route('signin');
    }
}
