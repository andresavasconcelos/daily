@extends('admin.layouts.app')

@section('title', 'Modelos / Newsletter')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Modelos</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li class="active">Modelos</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($models->total() > 1)
                            {{ $models->total() }} modelos no total - <small>Página {{ $models->currentPage() }} de {{ $models->lastPage() }}</small>
                        @else
                            {{ $models->total() }} modelo no total - <small>Página {{ $models->currentPage() }} de {{ $models->lastPage() }}</small>
                        @endif

                        <div class="panel-action">
                            <a href="{{ url('admin/newsletter/modelo/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar modelo</a>
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome do modelo</th>
                                        <th width="120">Adicionado</th>
                                        <th width="120">Atualizado</th>
                                        <th>Assunto</th>
                                        <th>Remetente</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($models->total() < 1)
                                    <tr class="vt-middle">
                                        <td colspan="6" class="text-center">
                                            Ainda não existe nenhum modelo cadastrado.<br /><br />
                                            <a href="{{ url('admin/newsletter/modelo/criar') }}" class="btn btn-info">
                                                <i class="fa fa-plus"></i> Criar o primeiro modelo
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                @foreach($models as $model)
                                    <tr class="vt-middle">
                                        <td><a href="{{ url('admin/newsletter/modelo/'.$model->id.'/editar') }}" class="text-muted"><strong>{{ $model->name }}</strong></a></td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->created_at)->format('d/m/y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $model->updated_at)->format('d/m/y H:i') }}</td>
                                        <td>{{ $model->subject }}</td>
                                        <td>
                                            {{ $model->senders_name }}<br />
                                            [{{ $model->senders_email }}]
                                        </td>
                                        <td align="center">
                                            <a class="btn btn-primary btn-circle waves-effect waves-light" href="{{ url('admin/newsletter/modelo/'.$model->id.'/fila-de-envio/criar') }}" data-toggle="tooltip" data-placement="top" title="Enviar">
                                                <i class="fa fa-send-o"></i>
                                            </a>
                                            <a class="btn btn-info btn-circle waves-effect waves-light" href="" data-toggle="tooltip" data-placement="top"  title="Visualizar">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a class="btn btn-danger btn-circle waves-effect waves-light" href="{{ url('admin/newsletter/modelo/'.$model->id.'/remover') }}" data-toggle="tooltip" data-placement="top"  title="Excluir">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <span class="m-l-10">{{ $models->links('vendor.pagination.bootstrap-4') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif
@endsection
