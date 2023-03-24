@extends('upload.layout')

@section('title', 'Adicionar arquivos')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-12 col-lg-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h2 class="text-left mb-3">Novo arquivo</h2>
            <form action="{{ route('upload.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="description" class="form-label">Descrição:</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descrição"
                        value="{{ old('description') }}" autocomplete="off" />
                </div>
                <div class="mb-2">
                    <label for="files" class="form-label">Arquivos:</label>
                    <input type="file" class="form-control" id="files" name="files[]" multiple />
                </div>
                <div class="mb-3 mt-3">
                    <div class="row">
                        <div class="col-sm-6 mb-3 d-grid">
                            <button type="submit" class="btn btn-success"><i class="bi bi-check-lg"></i> Salvar</button>
                        </div>
                        <div class="col-sm-6 mb-3 d-grid">
                            <a class="btn btn-outline-danger" href="{{ route('upload.list') }}"><i class="bi bi-reply"></i>
                                Voltar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
