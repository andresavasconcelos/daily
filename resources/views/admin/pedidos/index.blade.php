@extends('admin.layouts.app')

@section('title', 'Pedidos')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Pedidos</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/pedidos') }}">Pedidos</a></li>
                    <li class="active">Listar Pedidos</li>
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

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filtrar
                                </button>
                                @if(Request::get('q') || Request::get('pedido_numero') || Request::get('email') || Request::get('data_inicio') || Request::get('data_fim') || Request::get('situacao') || Request::get('forma_pagamento') || Request::get('forma_envio') || Request::get('cep') || Request::get('codigo_rastreio') || Request::get('cupom'))
                                    <a href="{{ url('admin/pedidos') }}" class="btn btn-default">
                                        <i class="fa fa-times"></i> Limpar
                                    </a>
                                @endif
                                <button type="button" class="btn btn-primary" id="open-filter">
                                    Mais opções <i class="fa fa-caret-down"></i>
                                </button>
                            </div>
                        </div>

                        <div class="row" id="filtro" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="pedido_numero">Número do pedido</label>
                                        <input type="text" class="form-control form-control-line" name="pedido_numero" id="pedido_numero" value="{{ Request::get('pedido_numero') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="data_inicio">Data de:</label>
                                        <div class="input-group">
                                            <input type="text" name="data_inicio" id="data_inicio" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ Request::get('data_inicio') }}" maxlength="10">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="data_fim">até</label>
                                        <div class="input-group">
                                            <input type="text" name="data_fim" id="data_fim" class="form-control form-control-line date datepicker" placeholder="00/00/0000" value="{{ (!is_null(Request::get('data_fim'))) ? Request::get('data_fim') : date('d/m/Y') }}" maxlength="10">
                                            <span class="input-group-addon"><i class="icon-calender"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control form-control-line" name="email" id="email" value="{{ Request::get('email') }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="situacao">Situação</label>
                                        <select class="form-control form-control-line select2" name="situacao" id="situacao">
                                            <option value=""> - </option>
                                            @foreach(\App\Pedidos::STATUS_ORDER as $status => $value)
                                            <option value="{{ $status }}" {{ (Request::get('situacao') == $status) ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="forma_pagamento">Pagamento</label>
                                        <select class="form-control form-control-line select2" name="forma_pagamento" id="forma_pagamento">
                                            <option value=""> - </option>
                                            @foreach(\App\Pedidos::PAYMENT as $pay => $value)
                                            <option value="{{ $pay }}" {{ (Request::get('forma_pagamento') == $pay) ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="forma_envio">Envio</label>
                                        <select class="form-control form-control-line select2" name="forma_envio" id="forma_envio">
                                            <option value=""> - </option>
                                            <option value="Sedex" {{ (Request::get('forma_envio') == 'Sedex') ? 'selected' : '' }}>SEDEX</option>
                                            <option value="PAC" {{ (Request::get('forma_envio') == 'PAC') ? 'selected' : '' }}>PAC</option>
                                            {{--<option value="3" {{ (Request::get('forma_envio') == '3') ? 'selected' : '' }}>e-SEDEX</option>--}}
                                            {{--<option value="194" {{ (Request::get('forma_envio') == '194') ? 'selected' : '' }}>Motoboy</option>--}}
                                            {{--<option value="12015" {{ (Request::get('forma_envio') == '12015') ? 'selected' : '' }}>Retirar pessoalmente</option>--}}
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label for="cep">CEP</label>
                                        <input type="text" class="form-control form-control-line cep" name="cep" id="cep" value="{{ Request::get('cep') }}" placeholder="00000-000">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="codigo_rastreio">Rastreamento</label>
                                        <input type="text" class="form-control form-control-line" name="codigo_rastreio" id="codigo_rastreio" value="{{ Request::get('codigo_rastreio') }}">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="cupom">Cupom</label>
                                        <input type="text" class="form-control form-control-line" name="cupom" id="cupom" value="{{ Request::get('cupom') }}">
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
                        @if($pedidos->total() > 1)
                            {{ $pedidos->total() }} pedidos no total - <small>Página {{ $pedidos->currentPage() }} de {{ $pedidos->lastPage() }}</small>
                        @else
                            {{ $pedidos->total() }} pedido no total - <small>Página {{ $pedidos->currentPage() }} de {{ $pedidos->lastPage() }}</small>
                        @endif

                        {{--<div class="panel-action">--}}
                        {{--<a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>--}}
                        {{--<a href="{{ url('admin/pedidos/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar produto</a>--}}
                        {{--</div>--}}
                    </div>

                    <div class="panel-wrapper collapse in">
                        <form id="form-del" action="{{ url('admin/pedido/remover') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="checkall" type="checkbox" class="select-all open-delete">
                                                    <label for="checkall">&nbsp;</label>
                                                </div>
                                            </th>
                                            <th class="text-center">#</th>
                                            <th width="250">Status</th>
                                            <th width="120">Data</th>
                                            <th>Cliente</th>
                                            <th class="text-center">Pagamento</th>
                                            <th>Envio</th>
                                            <th class="text-center">Total</th>
                                            <th width="90">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($pedidos->total() < 1)
                                        <tr class="vt-middle">
                                            <td colspan="9" class="text-center">
                                                Ainda não foi feito nenhum pedido.
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($pedidos as $pedido)
                                        <tr class="vt-middle">
                                            <td style="position:relative;left:10px;">
                                                <div class="checkbox">
                                                    <input id="option{{ $pedido->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $pedido->id }}">
                                                    <label for="option{{ $pedido->id }}">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <a href="{{ url('admin/pedido/'.$pedido->id.'/detalhar') }}" class="text-muted">
                                                    <strong>{{ $pedido->order_number }}</strong>
                                                </a>
                                                {{--<br />--}}
                                                {{--<span><strong>ID Stelo:</strong> {{ $pedido->id_stelo }}</span>--}}
                                            </td>
                                            <td>
                                                @if($pedido->status <= 3 || $pedido->status == 5 || $pedido->status == 9)
                                                    <i class="fa fa-circle text-info"></i>
                                                @elseif($pedido->status == 4 || $pedido->status > 5 && $pedido->status <= 8)
                                                    <i class="fa fa-circle text-success"></i>
                                                @elseif($pedido->status == 10)
                                                    <i class="fa fa-circle text-danger"></i>
                                                @endif
                                                {{ \App\Pedidos::STATUS_ORDER[$pedido->status] }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pedido->created_at)->format('d/m/y H:i') }}</td>
                                            <td>{{ $pedido->name }}</td>
                                            <td align="center">
												{{ \App\Pedidos::PAYMENT[$pedido->payment] }}
											</td>
                                            <td>{{ $pedido->ship_type }}</td>
                                            <td align="center">
												<strong class="text-success">
													@if($pedido->payment == 6)
														@php $totBoleto = (int) str_replace('.', '', $pedido->total) - (int) str_replace('.', '', $pedido->discount); @endphp
														@money($totBoleto, 'BRL')
													@else
														@money($pedido->total, 'BRL')
													@endif
												</strong>
											</td>
                                            <td>
                                                <a href="{{ url('admin/pedido/'.$pedido->id.'/detalhar') }}" class="btn btn-info btn-circle" data-toggle="tooltip" data-placement="top" title="Visualizar pedido">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ url('admin/pedido/'.$pedido->id.'/imprimir') }}" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="top" title="Imprimir pedido" target="_blank">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <span class="m-l-10">{{ $pedidos->links('vendor.pagination.bootstrap-4') }}</span>
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
