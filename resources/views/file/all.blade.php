@extends('file.layout')

@section('title', 'Todos os documentos')
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-10 col-lg-8">
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
            <h3>Todos os arquivos</h3>
            @foreach ($files as $file)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Adicionado por: {{ $file->user->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <span class="col-sm-12"><strong>N° do registro: </strong>{{ $file->id }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-12 col-md-6 col-lg-6 mt-2"><strong>Titulo:
                                </strong>{{ $file->title != '' ? $file->title : 'Sem título' }}</span>
                            <span class="col-sm-12 col-md-6 col-lg-6 mt-2"><strong>Email: </strong><a href="mailto:{{ $file->user->email }}"
                                    class="text-decoration-none">{{ $file->user->email }}</a></span>
                        </div>
                        <div class="row">
                            <span class="col-sm-12 col-md-6 col-lg-6 mt-2">
                                <strong>Arquivo:</strong>
                                <a href="{{ url('storage/' . $file->path) }}" target="_blank"
                                    class="btn btn-primary btn-sm text-decoration-none">Ver arquivo</a>
                                <a href="{{ route('file.download', $file->id) }}"
                                    class="btn btn-secondary btn-sm text-decoration-none">Download</a>
                            </span>
                            <span class="col-sm-12 col-md-6 col-lg-6 list-inline mt-2">
                                <strong>{{ $file->status == 'PENDENTE' ? '' : 'Status:' }} </strong>
                                @if ($file->status == 'PENDENTE')
                                    <strong class="list-inline-item">Ações:</strong>
                                    <form action="{{ route('file.updatestatus', $file->id) }}" method="post" class="list-inline-item">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="analist_name" value="{{ session('name') }}"/>
                                        <button type="submit" name="status" value="APROVADO"
                                            class="btn btn-success btn-sm">Aprovar</button>
                                        <button type="submit" name="status" value="REJEITADO"
                                            class="btn btn-danger btn-sm">Rejeitar</button>
                                    </form>
                                @elseif($file->status == 'APROVADO')
                                    <span class="text-success">APROVADO</span>
                                @else
                                    <span class="text-danger">REJEITADO</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <span class="col-sm-6"><strong>Cadastrado em:</strong> {{ $file->created_at }}
                            </span>
                            <span class="col-sm-6"><strong>Atualizado em:</strong> {{ $file->updated_at }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($files->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <h5>Sem arquivos cadastrados</h5>
                    </div>
                    <div class="card-body">
                        <h5>Nenhum arquivo cadastrado.</h5>
                    </div>
                    <div class="card-footer text-end">
                        <span><strong>Última atualização em </strong> {{ date('d/m/Y H:i:s') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
