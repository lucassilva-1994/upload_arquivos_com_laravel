<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css"/>
        <title>@yield('title','Gerenciamento de arquivos')</title>
    </head>
    <body>
        <nav class="pt-1" style="color: white;background-color: #0f5132;">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li class="nav-item nav-link link-light px-2">SGA</li>
                    <li class="nav-item"><a href="{{ route('upload.list') }}" class="nav-link link-light px-2">Arquivos</a></li>
                    <li class="nav-item"><a href="{{ route('upload.new') }}" class="nav-link link-light px-2">Novo arquivo</a></li>
                </ul>
                <ul class="nav">
                    <li class="nav-item nav-link link-light px-2"><i class="bi bi-person-circle"></i> {{ session('name'); }}</li>
                    <li class="nav-item"><a href="{{ route('signout') }}" class="nav-link link-light px-2"><i class="bi bi-box-arrow-in-right"></i> Sair</a></li>
                </ul>
            </div>
        </nav>
        <div class="container mt-3">@yield("content")</div>
    </body>
</html>
