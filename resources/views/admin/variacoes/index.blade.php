@extends('admin.layouts.app')

@section('title', 'Variações')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Variações</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li class="active">Variações</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <form class="form-material form-horizontal">
                        <div class="form-group m-b-0">
                            <div class="col-md-4">
                                <input type="text" class="form-control form-control-line" name="name" value="{{ Request::get('name') }}" placeholder="Nome da variação">
                            </div>

                            <div class="col-md-3 text-right">
                                <a href="{{ url('admin/variacoes') }}" class="btn btn-default">
                                    <i class="fa fa-times"></i> Limpar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if($variacoes->total() > 1)
                            {{ $variacoes->total() }} variações
                        @else
                            {{ $variacoes->total() }} variação
                        @endif

                        <div class="panel-action">
                            <a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>
                            <a href="{{ url('admin/variacao/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar variação</a>
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <form id="form-del" action="{{ url('admin/variacao/remover') }}" method="POST">
                            {{ csrf_field() }}

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="position:relative;left:10px;" width="55">
                                            <div class="checkbox">
                                                <input id="checkbox11" type="checkbox" class="select-all open-delete">
                                                <label for="checkbox11">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th width="230">Produtos vinculados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($variacoes->total() < 1)
                                    <tr class="vt-middle">
                                        <td colspan="7" class="text-center">
                                            Ainda não existe nenhuma variação cadastrada.<br /><br />
                                            <a href="{{ url('admin/variacao/criar') }}" class="btn btn-info">
                                                <i class="fa fa-plus"></i> Criar a primeira variação
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                                @foreach($variacoes as $variacao)
                                    <tr class="vt-middle">
                                        <td style="position:relative;left:10px;">
                                            <div class="checkbox">
                                                <input id="option{{ $variacao->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $variacao->id }}">
                                                <label for="option{{ $variacao->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="{{ url('admin/variacao/'.$variacao->id.'/editar') }}" class="text-muted"><strong>{{ $variacao->name }}</strong></a></td>
                                        <td align="center">
                                            @php $count = \App\ProdutosVariacoes::getVarProductsLinked($variacao->id) @endphp
                                            @if($count > 1)
                                            <span class="label label-table label-inverse">{{ $count }} produtos vinculados</span>
                                            @else
                                            <span class="label label-table label-inverse">{{ $count }} produto vinculado</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </form>

                        <span class="m-l-10">{{ $variacoes->links('vendor.pagination.bootstrap-4') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <div class="delete-button delete-box">
        <a class="btn btn-danger btn-lg submit-form" style="margin-top:-8px;"><i class="fa fa-trash"></i> Deletar</a>
    </div>
    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif
@endsection
