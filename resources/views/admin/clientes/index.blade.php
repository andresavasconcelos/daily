@extends('admin.layouts.app')

@section('title', 'Clientes')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Clientes</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('cliente') }}">Clientes</a></li>
                    <li class="active">Listar Clientes</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <form class="form-material form-horizontal">
                        <div class="form-group m-b-0 mgr-bt">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-line" name="q" value="{{ Request::get('q') }}" placeholder="{{ (isset($placeholder) && !empty($placeholder)) ? "Filtrando por: {$placeholder}" : '' }}">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filtrar
                                </button>
                                @if(Request::get('q') || Request::get('nome') || Request::get('email') || Request::get('de') || Request::get('ate') || Request::get('aniversario') || Request::get('status'))
                                <a href="{{ url('cliente') }}" class="btn btn-default">
                                    <i class="fa fa-times"></i> Limpar
                                </a>
                                @endif
                                <button type="button" class="btn btn-primary" id="open-filter">
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row" id="filtro" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control form-control-line" name="nome" id="nome" value="{{ Request::get('nome') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control form-control-line" name="email" id="email" value="{{ Request::get('email') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="de">Cadastrado de:</label>
                                        <div class="input-group">
                                            <input type="text" name="de" id="de" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ Request::get('de') }}" maxlength="10">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="ate">até</label>
                                        <div class="input-group">
                                            <input type="text" name="ate" id="ate" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ Request::get('ate') }}" maxlength="10">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="aniversario">Aniversário</label>
                                        <select class="form-control form-control-line select2" name="aniversario">
                                            <option value=""> - </option>
                                            <option value="hoje" {{ (Request::get('aniversario') == 'hoje') ? 'selected' : '' }}>Hoje</option>
                                            <option value="1" {{ (Request::get('aniversario') == '1') ? 'selected' : '' }}>Janeiro</option>
                                            <option value="2" {{ (Request::get('aniversario') == '2') ? 'selected' : '' }}>Fevereiro</option>
                                            <option value="3" {{ (Request::get('aniversario') == '3') ? 'selected' : '' }}>Março</option>
                                            <option value="4" {{ (Request::get('aniversario') == '4') ? 'selected' : '' }}>Abril</option>
                                            <option value="5" {{ (Request::get('aniversario') == '5') ? 'selected' : '' }}>Maio</option>
                                            <option value="6" {{ (Request::get('aniversario') == '6') ? 'selected' : '' }}>Junho</option>
                                            <option value="7" {{ (Request::get('aniversario') == '7') ? 'selected' : '' }}>Julho</option>
                                            <option value="8" {{ (Request::get('aniversario') == '8') ? 'selected' : '' }}>Agosto</option>
                                            <option value="9" {{ (Request::get('aniversario') == '9') ? 'selected' : '' }}>Setembro</option>
                                            <option value="10" {{ (Request::get('aniversario') == '10') ? 'selected' : '' }}>Outubro</option>
                                            <option value="11" {{ (Request::get('aniversario') == '11') ? 'selected' : '' }}>Novembro</option>
                                            <option value="12" {{ (Request::get('aniversario') == '12') ? 'selected' : '' }}>Dezembro</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="status">Status</label>
                                        <select class="form-control form-control-line select2" name="status" id="status">
                                            <option value=""> - </option>
                                            <option value="1" {{ (Request::get('status') == '1') ? 'selected' : '' }}>Ativado</option>
                                            <option value="0" {{ (Request::get('status') == '0') ? 'selected' : '' }}>Desativado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 m-b-0">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-filter"></i> Filtrar
                                    </button>
                                </div>
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
                        @if($clientes->total() > 1)
                            {{ $clientes->total() }} clientes no total - <small>Página {{ $clientes->currentPage() }} de {{ $clientes->lastPage() }}</small>
                        @else
                            {{ $clientes->total() }} cliente no total - <small>Página {{ $clientes->currentPage() }} de {{ $clientes->lastPage() }}</small>
                        @endif

                        {{--<div class="panel-action">--}}
                            {{--<a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>--}}
                            {{--<a href="{{ url('admin/cliente/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar produto</a>--}}
                        {{--</div>--}}
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="border-right:0">&nbsp;</th>
                                        <th style="border-left:0">Nome</th>
                                        <th>E-mail</th>
                                        <th>Pedidos</th>
                                        <th>Cadastrado há</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($clientes->total() < 1)
                                    <tr class="vt-middle">
                                        <td colspan="7" class="text-center">
                                            Ainda não existe cliente cadastrado.
                                        </td>
                                    </tr>
                                @endif
                                @foreach($clientes as $cliente)
                                    <tr class="vt-middle">
                                        <td class="text-center" style="border-right:0">
                                            @if($cliente->document == 'CNPJ')
                                            <i class="fa fa-suitcase"></i>
                                            @endif
                                        </td>
                                        <td style="border-left:0">
                                            <a href="{{ url('admin/cliente/'.$cliente->id.'/detalhar') }}" class="text-muted">
                                                <strong>{{ $cliente->name }}</strong>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/cliente/'.$cliente->id.'/detalhar') }}" class="text-muted">
                                                {{ $cliente->email }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            @if(\App\Pedidos::where('id_user', $cliente->id)->count() == 0)
                                                <strong>0</strong>
                                            @else
                                            <a href="{{ url('admin/pedidos?q=&pedido_numero=&data_inicio=&data_fim=30%2F06%2F2017&email='.$cliente->email.'&situacao=&forma_pagamento=&forma_envio=&cep=&codigo_rastreio=&cupom=') }}" class="text-muted">
                                                <strong>{{ \App\Pedidos::where('id_user', $cliente->id)->count() }}</strong>
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{ \App\User::getTime($cliente->id) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <span class="m-l-10">{{ $clientes->links('vendor.pagination.bootstrap-4') }}</span>
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
