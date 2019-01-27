@extends('admin.layouts.app')

@section('title', 'Newsletter')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Newsletter</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/newsletter') }}">Newsletter</a></li>
                    <li class="active">Listar Newsletter</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    {{--<form class="form-material form-horizontal">--}}
                        {{--<div class="form-group m-b-0">--}}
                            {{--<div class="col-md-4">--}}
                                {{--<input type="text" class="form-control form-control-line" name="q" value="{{ Request::get('q') }}" placeholder="Nome, Descrição, URL, Código do produto">--}}
                            {{--</div>--}}

                            {{--<div class="col-md-3">--}}
                                {{--<select class="form-control form-control-line select2" name="listagem">--}}
                                    {{--<option value="alfabetica" {{ (Request::get('listagem') == 'alfabetica') ? 'selected' : '' }}>Ordem alfabética</option>--}}
                                    {{--<option value="ultimos_produtos" {{ (Request::get('listagem') == 'ultimos_produtos') ? 'selected' : '' }}>Últimos produtos</option>--}}
                                    {{--<option value="destaque" {{ (Request::get('listagem') == 'destaque') ? 'selected' : '' }}>Destaque</option>--}}
                                    {{--<option value="mais_vendidos" {{ (Request::get('listagem') == 'mais_vendidos') ? 'selected' : '' }}>Mais vendidos</option>--}}
                                    {{--<option value="indisponiveis" {{ (Request::get('listagem') == 'indisponiveis') ? 'selected' : '' }}>Indisponíveis</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            {{--<div class="col-md-2">--}}
                                {{--<select class="form-control form-control-line select2" name="filtro">--}}
                                    {{--<option value="">- Filtro -</option>--}}
                                    {{--<option value="ativo" {{ (Request::get('filtro') == 'ativo') ? 'selected' : '' }}>Ativos</option>--}}
                                    {{--<option value="inativo" {{ (Request::get('filtro') == 'inativo') ? 'selected' : '' }}>Inativos</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}

                            {{--<div class="col-md-3 text-right">--}}
                                {{--<a href="{{ url('admin/produtos') }}" class="btn btn-default">--}}
                                    {{--<i class="fa fa-times"></i> Limpar--}}
                                {{--</a>--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--<i class="fa fa-filter"></i> Filtrar--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Newsletter
                        {{--@if($produtos->total() > 1)--}}
                            {{--{{ $produtos->total() }} produtos no total - <small>Página {{ $produtos->currentPage() }} de {{ $produtos->lastPage() }}</small>--}}
                        {{--@else--}}
                            {{--{{ $produtos->total() }} produto no total - <small>Página {{ $produtos->currentPage() }} de {{ $produtos->lastPage() }}</small>--}}
                        {{--@endif--}}

                        {{--<div class="panel-action">--}}
                            {{--<a class="btn btn-danger delete-button submit-form" style="margin-top:-8px;display:none"><i class="fa fa-trash"></i> Deletar</a>--}}
                            {{--<a href="{{ url('admin/produto/criar') }}" class="btn btn-info text-white" style="margin-top:-8px;"><i class="fa fa-plus"></i> Criar produto</a>--}}
                        {{--</div>--}}
                    </div>

                    <div class="panel-wrapper collapse in">
                        {{--<form id="form-del" action="{{ url('admin/produto/remover') }}" method="POST">--}}
                            {{--{{ csrf_field() }}--}}

                            {{--<div class="table-responsive">--}}
                                {{--<table class="table table-bordered table-striped">--}}
                                    {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th style="position:relative;left:10px;">--}}
                                                {{--<div class="checkbox">--}}
                                                    {{--<input id="checkall" type="checkbox" class="select-all open-delete">--}}
                                                    {{--<label for="checkall">&nbsp;</label>--}}
                                                {{--</div>--}}
                                            {{--</th>--}}
                                            {{--<th colspan="2">Produto</th>--}}
                                            {{--<th>Categoria(s)</th>--}}
                                            {{--<th>Preço</th>--}}
                                            {{--<th>Status</th>--}}
                                            {{--<th>Estoque</th>--}}
                                        {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                    {{--@if($produtos->total() < 1)--}}
                                        {{--<tr class="vt-middle">--}}
                                            {{--<td colspan="7" class="text-center">--}}
                                                {{--Ainda não existe nenhum produto cadastrado.<br /><br />--}}
                                                {{--<a href="{{ url('admin/produto/criar') }}" class="btn btn-info">--}}
                                                    {{--<i class="fa fa-plus"></i> Criar o primeiro produto--}}
                                                {{--</a>--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--@endif--}}
                                    {{--@foreach($produtos as $produto)--}}
                                        {{--<tr class="vt-middle">--}}
                                            {{--<td style="position:relative;left:10px;">--}}
                                                {{--<div class="checkbox">--}}
                                                    {{--<input id="option{{ $produto->id }}" name="options[]" type="checkbox" class="open-delete" value="{{ $produto->id }}">--}}
                                                    {{--<label for="option{{ $produto->id }}">&nbsp;</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td align="center">--}}
                                                {{--@if(is_null(\App\ProdutosImagens::getImage($produto->id)))--}}
                                                    {{--<i class="ti-image" style="font-size:24px"></i>--}}
                                                {{--@else--}}
                                                    {{--<img src="{{ asset(\App\ProdutosImagens::getImage($produto->id)) }}" alt="{{ $produto->title }}" class="img-table">--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--<a href="{{ url('admin/produto/'.$produto->id.'/editar') }}" class="text-muted">--}}
                                                    {{--<strong>{{ $produto->title }}</strong><br />--}}
                                                    {{--REF: {{ $produto->code }}<br />--}}
                                                    {{--Tipo: <strong class="text-info">{{ ($produto->type == 'SIMPLE') ? 'Normal' : 'Com opções' }}</strong>--}}
                                                {{--</a>--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--@php $cat = '' @endphp--}}
                                                {{--@foreach($categorias as $categoria)--}}
                                                    {{--@php $cat .= ($categoria->id == \App\ProdutosCategorias::getCategoryId($produto->id, $categoria->id)) ? $categoria->title.', ' : '' @endphp--}}
                                                {{--@endforeach--}}
                                                {{--{{ rtrim($cat, ', ') }}--}}
                                            {{--</td>--}}
                                            {{--<td class="text-right">--}}
                                                {{--@if($produto->price)--}}
                                                    {{--@if($produto->offer_price != '0.00' && !is_null($produto->offer_price))--}}
                                                        {{--<s>de @money($produto->price, 'BRL')</s><br />--}}
                                                        {{--<strong>por @money($produto->offer_price, 'BRL')</strong>--}}
                                                    {{--@else--}}
                                                        {{--<strong>@money($produto->price, 'BRL')</strong>--}}
                                                    {{--@endif--}}
                                                {{--@else--}}
                                                    {{--<strong>-</strong>--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                            {{--<td align="center">--}}
                                                {{--<span class="label label-{{ ($produto->status) ? 'info' : 'inverse' }}">{{ ($produto->status) ? 'Ativo' : 'Inativo' }}</span>--}}
                                            {{--</td>--}}
                                            {{--<td align="center">--}}
                                                {{--@if($produto->manage_stock == 0 && $produto->in_stock == 1)--}}
                                                {{--<span class="label label-success">Disponível</span>--}}
                                                {{--@elseif($produto->manage_stock == 1 && $produto->inventory > 1)--}}
                                                {{--<span class="label label-success">{{ $produto->inventory }} em estoque</span>--}}
                                                {{--@elseif($produto->type == 'VARIABLE')--}}
                                                {{--<a href="{{ url('admin/produto/'.$produto->id.'/editar') }}"><span class="label label-inverse">Consultar variação</span></a>--}}
                                                {{--@else--}}
                                                {{--<span class="label label-danger">Indisponível</span>--}}
                                                {{--@endif--}}
                                            {{--</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}
                        {{--</form>--}}

                        {{--<span class="m-l-10">{{ $produtos->links('vendor.pagination.bootstrap-4') }}</span>--}}
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
