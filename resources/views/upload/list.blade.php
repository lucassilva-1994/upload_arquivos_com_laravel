@extends('upload.layout')

@section('title', 'Seus documentos')
@section('content')

    <div class="row justify-content-md-center">
        <div class="col-sm-12 col-md-12 col-lg-8">
            <h3>Seus documentos</h3>
            @foreach ($uploads as $upload)
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>{{ $upload->title != '' ? $upload->title : 'Sem título' }}</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('storage/' . $upload->path) }}" target="_blank" class="link-primary"
                            style="text-decoration: none;">Ver documento</a>
                        <div class="row mt-3">
                            @if ($upload->status == 'PENDENTE')
                                <span class="text-warning">PENDENTE</span>
                            @elseif ($upload->status == 'APROVADO')
                               <span class="text-success">APROVADO</span>
                            @else
                                <span class="text-danger">REJEITADO</span>
                            @endif
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
        </div>
    </div>
@endsection
