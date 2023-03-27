@extends('user.layout')
@section('title', 'Entrar')
@section('content')
@section('header','Entrar')
    <form action="{{ route('auth') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu e-mail"
                value="{{ old('email') }}" autocomplete="off" />
        </div>
        <div class="mb-2">
            <label for="password" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha"
                value="{{ old('password') }}" autocomplete="off" />
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="checkbox" onclick="showHiddenPassword()">
            <label class="form-check-label" for="checkbox">
                Mostrar senha
            </label>
        </div>
        <div class="mb-3 mt-2 ">
            <div class="row">
                <div class="col-sm-6 mb-2 d-grid">
                    <button type="submit" class="btn btn-success"><i class="bi bi-person-check-fill"></i> Autenticar</button>
                </div>
                <div class="col-sm-6 mb-2 d-grid">
                    <a class="btn btn-primary" href="{{ route('signup') }}"><i class="bi bi-person-plus-fill"></i> Cadastrar-se</a>
                </div>
            </div>
        </div>
    </form>
@endsection
