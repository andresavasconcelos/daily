@extends('admin.layouts.app')

@section('title', 'Frete Grátis')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Frete Grátis</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li class="active">Frete Grátis</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    O frete grátis será aplicado na forma de envio de menor valor.
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Frete grátis por Região
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <form class="form-material form-horizontal" role="form" action="{{ url('admin/frete-gratis/regiao/salvar') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="50">Ativo</th>
                                                <th class="text-center" width="230">Região</th>
                                                <th class="text-center" width="230">
                                                    Valor mínimo do pedido
                                                    <a href="javascript:void(0)" class="text-muted" data-toggle="tooltip" data-placement="top" title='Mínimo referente apenas ao valor "subtotal" do pedido. Descontos aplicados via cupom ou outros meios não são contabilizados'>
                                                        <i class="fa fa-question-circle"></i>
                                                    </a>
                                                </th>
                                                <th class="text-center">Faixa de CEP</th>
                                                <th width="70">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fretes as $frete)
                                            <tr class="vt-middle">
                                                <td style="position:relative;left:10px;">
                                                    <div class="checkbox">
                                                        <input id="region_{{ $frete->id }}" name="regions[]" type="checkbox" value="{{ $frete->id }}" {{ ($frete->status) ? 'checked' : '' }}>
                                                        <label for="region_{{ $frete->id }}">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    @if($frete->id <= 5)
                                                        {{ $frete->region }}
                                                    @else
                                                        <div class="form-group m-b-0 m-r-5 m-l-5">
                                                            <input id="input-group-text" type="text" name="region_{{ $frete->id }}" class="form-control form-control-line" placeholder="Personalizado" value="{{ $frete->region }}" style="background-color:#FFF">
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-group m-b-0 m-r-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">R$</span>
                                                            <input id="input-group-text" type="text" name="value_min_{{ $frete->id }}" class="form-control form-control-line money" placeholder="0,00" value="{{ $frete->value_min }}" maxlength="22" style="background-color:#FFF">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($frete->id <= 5)
                                                        &nbsp;
                                                    @else
                                                        <div class="form-group m-b-0 m-r-5 m-l-5">
                                                            <div class="input-group">
                                                                <input id="input-group-text" type="text" name="cep_start_{{ $frete->id }}" class="form-control form-control-line cep" placeholder="00000-000" value="{{ $frete->cep_start }}" maxlength="9" style="background-color:#FFF">
                                                                <span class="input-group-addon">até</span>
                                                                <input id="input-group-text" type="text" name="cep_end_{{ $frete->id }}" class="form-control form-control-line cep" placeholder="00000-000" value="{{ $frete->cep_end }}" maxlength="9" style="background-color:#FFF">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($frete->id <= 5)
                                                        &nbsp;
                                                    @else
                                                        <a class="btn btn-danger btn-circle waves-effect waves-light" href="{{ url('admin/frete-gratis/'.$frete->id.'/remover') }}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                            <tr class="vt-middle" id="new-region" style="display:none">
                                                <td style="position:relative;left:10px;">
                                                    <div class="checkbox">
                                                        <input id="new_region" name="new_region" type="checkbox" value="0" checked>
                                                        <label for="new_region">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-group m-b-0 m-r-5 m-l-5">
                                                        <input id="input-group-text" type="text" name="region" class="form-control form-control-line" placeholder="Personalizado" value="" style="background-color:#FFF">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group m-b-0 m-r-5">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">R$</span>
                                                            <input id="input-group-text" type="text" name="value_min" class="form-control form-control-line money" placeholder="0,00" value="" maxlength="22" style="background-color:#FFF">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group m-b-0 m-r-5 m-l-5">
                                                        <div class="input-group">
                                                            <input id="input-group-text" type="text" name="cep_start" class="form-control form-control-line cep" placeholder="00000-000" value="" maxlength="9" style="background-color:#FFF">
                                                            <span class="input-group-addon">até</span>
                                                            <input id="input-group-text" type="text" name="cep_end" class="form-control form-control-line cep" placeholder="00000-000" value="" maxlength="9" style="background-color:#FFF">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" id="remove-region" class="btn btn-danger btn-circle waves-effect waves-light">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="button" id="add-region" class="btn btn-default btn-block waves-effect waves-light btn-rounded">
                                    <i class="fa fa-plus"></i> Nova Região
                                </button><br /><br />

                                <span class="m-b-20 row">{{ $fretes->links('vendor.pagination.bootstrap-4') }}</span>

                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    <i class="fa fa-check"></i> Salvar alterações
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">--}}
                        {{--Frete grátis por Produto--}}
                    {{--</div>--}}

                    {{--<div class="panel-wrapper collapse in">--}}
                        {{--<div class="panel-body p-b-10">--}}
                            {{--<div class="alert alert-info">--}}
                                {{--Os produtos selecionados terão frete grátis independente da região selecionada acima.--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<form action="" method="POST">--}}
                            {{--{{ csrf_field() }}--}}

                            {{--<div class="table-responsive">--}}
                                {{--<table class="table table-bordered table-striped">--}}
                                    {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th width="55">&nbsp;</th>--}}
                                            {{--<th>Nome do produto</th>--}}
                                            {{--<th>Valor</th>--}}
                                            {{--<th>Estoque</th>--}}
                                        {{--</tr>--}}
                                    {{--</thead>--}}
                                    {{--<tbody>--}}
                                        {{--<tr class="vt-middle">--}}
                                            {{--<td style="position:relative;left:10px;">--}}
                                                {{--<div class="checkbox">--}}
                                                    {{--<input id="option" name="options[]" type="checkbox" class="open-delete" value="">--}}
                                                    {{--<label for="option">&nbsp;</label>--}}
                                                {{--</div>--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--Teste--}}
                                                {{--<strong>{{ $produto->title }}</strong>--}}
                                            {{--</td>--}}
                                            {{--<td>--}}
                                                {{--R$ 26,90--}}
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
                                            {{--<td>--}}
                                                {{--Disponível--}}
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
                                    {{--</tbody>--}}
                                {{--</table>--}}
                            {{--</div>--}}

                            {{--<div class="panel-body p-t-10">--}}
                                {{--<button type="submit" class="btn btn-success waves-effect waves-light">--}}
                                    {{--<i class="fa fa-check"></i> Salvar alterações--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</form>--}}

                        {{--<span class="m-l-10">{{ $produtos->links('vendor.pagination.bootstrap-4') }}</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <!-- /.container-fluid -->

    @if(session('status'))
        <div class="alert alert-success alert-dismissable alert-fixed">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>
            <i class="ti-check"></i> {{ session('status') }}
        </div>
    @endif
@endsection
