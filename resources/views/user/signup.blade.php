@extends('user.layout')
@section('title', 'Cadastro')
@section('content')
@section('header','Cadastro')
    <form action="{{ route('create') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="name" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome"
                value="{{ old('name') }}" autocomplete="off" />
        </div>
        <div class="mb-2">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Seu email"
                value="{{ old('email') }}" autocomplete="off" />
        </div>
        <div class="mb-2">
            <label for="cpassword" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Sua senha"
                value="{{ old('cpassword') }}" autocomplete="off" />
        </div>
        <div class="mb-2">
            <label for="ccpassword" class="form-label">Confirmar senha:</label>
            <input type="password" class="form-control" id="ccpassword" name="ccpassword" placeholder="Confirme sua senha"
                value="{{ old('ccpassword') }}" autocomplete="off" />
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" id="checkbox" onclick="showHiddenPasswords()">
            <label class="form-check-label" for="checkbox">
                Conferir senhas
            </label>
        </div>
        <div class="mb-3 mt-2 ">
            <div class="row">
                <div class="col-sm-6 mb-2 d-grid">
                    <button type="submit" class="btn btn-success"><i class="bi bi-send-fill"></i> Enviar</button>
                </div>
                <div class="col-sm-6 mb-2 d-grid">
                    <a class="btn btn-secondary" href="{{ route('signin') }}"><i class="bi bi-reply-fill"></i> Voltar</a>
                </div>
            </div>
        </div>
    </form>
@endsection
