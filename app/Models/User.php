<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $table = "users";

    public static function userCreate(array $data){
        $data['password'] = bcrypt($data['cpassword']);
        $user = User::create($data);
        if($user){
            return to_route('signin')->with('success', 'Usuário cadastrado com sucesso.');
        }
        return redirect()->back()->with('error', 'Falha ao realizar cadastro.');
    }
}
