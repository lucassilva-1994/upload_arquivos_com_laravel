@extends('file.layout')

@section('title', 'Seus documentos')
@section('content')

    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-12 col-lg-8">
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
            <h3>Seus Arquivos</h3>
            @foreach ($files as $file)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>{{ $file->title != '' ? $file->title : 'Sem título' }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <span class="col-sm-12"><strong>N° do registro: </strong>{{ $file->id }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-6 list-inline">
                                <strong class="list-inline-item">Analisado por:</strong>
                                {{ $file->analist_name == '' ? 'Sem análise.' : $file->analist_name }}
                            </span>
                            <span class="col-sm-6">
                                <strong>Status: </strong>
                                @if ($file->status == 'PENDENTE')
                                    <span class="text-warning">AGUARDANDO ANALISE</span>
                                @elseif($file->status == 'APROVADO')
                                    <span class="text-success">APROVADO</span>
                                @else
                                    <span class="text-danger">REJEITADO</span>
                                @endif
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-sm-6">
                                <strong>Arquivo:</strong>
                                <a href="{{ url('storage/' . $file->path) }}" target="_blank"
                                    class="btn btn-primary btn-sm text-decoration-none">Ver arquivo</a>
                                <a href="{{ route('file.download', $file->id) }}"
                                    class="btn btn-secondary btn-sm text-decoration-none">Download</a>
                            </span>
                            <span class="col-sm-6 list-inline">
                                <strong class="list-inline-item">Ações: </strong>
                                <form action="{{ route('file.delete', $file->id) }}" method="post"
                                    class="list-inline-item">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                                <form action="{{ route('file.updatestatus', $file->id) }}" method="post"
                                    class="list-inline-item">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="analist_name" value="" />
                                    <button class="btn btn-primary btn-sm" name="status" value="PENDENTE"
                                        {{ $file->status == 'APROVADO' || $file->status == 'PENDENTE' ? 'disabled' : '' }}>Reenviar
                                        para análise</button>
                                </form>
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <span class="col-sm-6"><strong>Cadastrado em:</strong> {{ $file->created_at }} </span>
                            <span class="col-sm-6"><strong>Atualizado em:</strong> {{ $file->updated_at }} </span>
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
                        <h5>Você não tem arquivos cadastrado,
                            <a href="{{ route('file.new') }}" class="text-decoration-none">clique aqui</a>
                            para registrar um arquivo.
                        </h5>
                    </div>
                    <div class="card-footer text-end">
                        <span><strong>Última atualização em </strong> {{ date('d/m/Y H:i:s') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection