@extends('upload.layout')

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
            @foreach ($uploads as $upload)
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Adicionado por: {{ $upload->user->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <span class="col-sm-12"><strong>N° do registro: </strong>{{ $upload->id }}</span>
                        </div>
                        <div class="row">
                            <span class="col-sm-6"><strong>Titulo:
                                </strong>{{ $upload->title != '' ? $upload->title : 'Sem título' }}</span>
                            <span class="col-sm-6"><strong>Email: </strong><a href="mailto:{{ $upload->user->email }}"
                                    class="text-decoration-none">{{ $upload->user->email }}</a></span>
                        </div>
                        <div class="row">
                            <span class="col-sm-6">
                                <strong>Arquivo:</strong>
                                <a href="{{ url('storage/' . $upload->path) }}" target="_blank"
                                    class="link-primary text-decoration-none">Ver arquivo</a>
                            </span>
                            <span class="col-sm-6">
                                <strong>{{ $upload->status == 'PENDENTE' ? '' : 'Status:' }} </strong>
                                @if ($upload->status == 'PENDENTE')
                                    <form action="{{ route('upload.updatestatus', $upload->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <span><strong>Ações:</strong></span>
                                        <button type="submit" name="status" value="APROVADO"
                                            class="btn btn-success btn-sm">APROVAR</button>
                                        <button type="submit" name="status" value="REJEITADO"
                                            class="btn btn-danger btn-sm">REJEITAR</button>
                                    </form>
                                @elseif($upload->status == 'APROVADO')
                                    <span class="text-success">APROVADO</span>
                                @else
                                    <span class="text-danger">REJEITADO</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <span class="col-sm-6"><strong>Cadastrado em:</strong> {{ $upload->created_at }}
                            </span>
                            <span class="col-sm-6"><strong>Atualizado em:</strong> {{ $upload->updated_at }}
                            </span>
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
