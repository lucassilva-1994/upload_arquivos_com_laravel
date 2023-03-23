@extends('user.layout')
@section('title', 'Entrar')
@section('content')
    <h2 class="text-center mb-3">Entrar</h2>
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
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Autenticar</button>
                </div>
                <div class="col-sm-6 mb-2 d-grid">
                    <a class="btn btn-outline-primary" href="{{ route('signup') }}"><i class="bi bi-plus"></i> Cadastrar-se</a>
                </div>
            </div>
        </div>
    </form>
@endsection
