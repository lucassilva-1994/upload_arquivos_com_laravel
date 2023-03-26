@extends('upload.layout')

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
            @foreach ($uploads as $upload)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>{{ $upload->title != '' ? $upload->title : 'Sem título' }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <span class="col-sm-12"><strong>N° do registro: </strong>{{ $upload->id }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-6">
                                <strong>Arquivo:</strong>
                                <a href="{{ url('storage/' . $upload->path) }}" target="_blank"
                                    class="link-primary text-decoration-none">Ver arquivo</a>
                            </span>
                            <span class="col-sm-6">
                                <strong>Status: </strong>
                                @if ($upload->status == 'PENDENTE')
                                    <span class="text-warning">AGUARDANDO ANALISE</span>
                                @elseif($upload->status == 'APROVADO')
                                    <span class="text-success">APROVADO</span>
                                @else
                                    <span class="text-danger">REJEITADO</span>
                                @endif
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-sm-6 list-inline">
                                <strong class="list-inline-item">Avaliado por:</strong> Sem nome
                            </span>
                            <span class="col-sm-6 list-inline">
                                <strong class="list-inline-item">Ações: </strong>
                                <form action="{{ route('upload.delete', $upload->id) }}" method="post" class="list-inline-item">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                                <form  action="{{ route('upload.updatestatus', $upload->id) }}" method="post" class="list-inline-item">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-primary btn-sm"
                                    name="status" value="PENDENTE"
                                        {{ $upload->status == "APROVADO" || $upload->status == "PENDENTE" ? "disabled" : "" }}>Reenviar para analise</button>
                                </form>
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <span class="col-sm-6"><strong>Cadastrado em:</strong> {{ $upload->created_at }} </span>
                            <span class="col-sm-6"><strong>Atualizado em:</strong> {{ $upload->updated_at }} </span>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($uploads->isEmpty())
                <div class="card">
                    <div class="card-header">
                        <h5>Sem arquivos cadastrados</h5>
                    </div>
                    <div class="card-body">
                        <h5>Você não tem arquivos cadastrado,
                            <a href="{{ route('upload.new') }}" class="text-decoration-none">clique aqui</a>
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
