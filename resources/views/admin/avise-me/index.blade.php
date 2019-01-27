@extends('admin.layouts.app')

@section('title', 'Avise-me')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Avise-me</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/avise-me') }}">Avise-me</a></li>
                    <li class="active">Listar Avise-me</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($avisos->total() > 1)
                            {{ $avisos->total() }} produtos no total - <small>Página {{ $avisos->currentPage() }} de {{ $avisos->lastPage() }}</small>
                        @else
                            {{ $avisos->total() }} produto no total - <small>Página {{ $avisos->currentPage() }} de {{ $avisos->lastPage() }}</small>
                        @endif
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Produto</th>
                                        <th width="150" class="text-center">Nº de Solicitações</th>
                                        <th width="100">Estoque</th>
                                        <th width="100">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($avisos->total() < 1)
                                    <tr class="vt-middle">
                                        <td colspan="5" class="text-center">
                                            Nenhuma solicitação.
                                        </td>
                                    </tr>
                                @endif
                                @foreach($avisos as $aviso)
                                    @php $produto = \App\Produtos::getProduct($aviso->id_product) @endphp
                                    <tr class="vt-middle">
                                        <td align="center">
                                            @if(is_null(\App\ProdutosImagens::getImage($produto->id)))
                                                @if(is_null(\App\ProdutosImagens::getImage($produto->id_parent)))
                                                    <i class="ti-image" style="font-size:24px"></i>
                                                @else
                                                    <img src="{{ asset(\App\ProdutosImagens::getImage($produto->id_parent)) }}" alt="{{ $produto->title }}" class="img-table">
                                                @endif
                                            @else
                                                <img src="{{ asset(\App\ProdutosImagens::getImage($produto->id)) }}" alt="{{ $produto->title }}" class="img-table">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/produto/'.$produto->id.'/editar') }}" class="text-muted">
                                                <strong>{{ $produto->title }}</strong><br />
                                                REF: {{ $produto->code }}<br />
                                                Tipo: <strong class="text-info">{{ ($produto->type == 'SIMPLE') ? 'Simples' : 'Variável' }}</strong>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <h1 class="text-info">
                                                <span style="font-weight:500">{{ \App\ProdutosAviseUsers::getCountUsersNotify($aviso->id) }}</span>
                                            </h1>
                                        </td>
                                        <td align="center">
                                            @if($produto->manage_stock == 0 && $produto->in_stock == 1)
                                                <span class="label label-success">Disponível</span>
                                            @elseif($produto->manage_stock == 1 && $produto->inventory > 1)
                                                <span class="label label-success">{{ $produto->inventory }} em estoque</span>
                                            @elseif($produto->type == 'VARIABLE')
                                                <a href="{{ url('admin/produto/'.$produto->id.'/editar') }}"><span class="label label-inverse">Consultar variação</span></a>
                                            @else
                                                <span class="label label-danger">Indisponível</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#Modal-{{ $aviso->id }}">
                                                <i class="fa fa-bell-o"></i> Notificar clientes
                                            </button>

                                            <div id="Modal-{{ $aviso->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="myModalLabel">Pessoas na lista de "avise-me" desse produto</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            @php $notifies = \App\ProdutosAviseUsers::where('id_notify', $aviso->id)->get() @endphp
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Nome</th>
                                                                        <th>E-mail</th>
                                                                        <th>Solicitado há</th>
                                                                    </tr>
                                                                </thead>
                                                                <thead>
                                                                    @foreach($notifies as $notify)
                                                                    <tr>
                                                                        <td>{{ $notify->name }}</td>
                                                                        <td>{{ $notify->email }}</td>
                                                                        <td>{{ \App\ProdutosAviseUsers::getTime($notify->created_at) }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </thead>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="{{ url('admin/avise-me/'.$aviso->id.'/lista/'.$produto->code.'/exportar') }}" class="btn btn-outline-info btn-rounded waves-effect waves-light">
                                                                <i class="fa fa-download"></i> Exportar lista
                                                            </a>
                                                            {{--<button type="button" class="btn btn-default waves-effect waves-light">Adicionar cliente</button>--}}
                                                            <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">
                                                                <i class="fa fa-bell-o"></i> Notificar clientes
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <span class="m-l-10">{{ $avisos->links('vendor.pagination.bootstrap-4') }}</span>
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
