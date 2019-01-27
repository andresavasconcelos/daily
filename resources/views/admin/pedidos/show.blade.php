@extends('admin.layouts.app')

@section('title', 'Detalhar pedido')

@section('content')
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Detalhar pedido</h4>
            </div>

            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/admin/painel') }}">Painel</a></li>
                    <li><a href="{{ url('/admin/pedidos') }}">Pedidos</a></li>
                    <li class="active">Detalhar pedido</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Detalhes de venda #{{ $pedido->order_number }}

                        <div class="panel-action">
                            Criado em {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pedido->created_at)->format('d/m/Y H:i') }}
                        </div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="well">
                                        <form class="form-material form-horizontal" action="{{ url('admin/pedido/'.$pedido->id.'/status/salvar') }}" method="POST">
                                            {{ csrf_field() }}

                                            <div class="form-group m-b-0">
                                                <div class="col-md-8">
                                                    <label for="situacao">Situação do pedido:</label>
                                                    <select class="form-control selectpicker" name="situacao_select" id="situacao_select_{{ $pedido->id }}" data-container="body" {{ ($pedido->status == 10) ? 'disabled' : '' }}>
                                                        <option value="1" {{ ($pedido->status == 1) ? 'selected' : '' }} data-icon="fa fa-circle text-info">Pedido Efetuado</option>
                                                        <option value="2" {{ ($pedido->status == 2) ? 'selected' : '' }} data-icon="fa fa-circle text-info">Aguardando pagamento</option>
                                                        <option value="3" {{ ($pedido->status == 3) ? 'selected' : '' }} data-icon="fa fa-circle text-info">Pagamento em análise</option>
                                                        <option value="4" {{ ($pedido->status == 4) ? 'selected' : '' }} data-icon="fa fa-circle text-success">Pedido Pago</option>
                                                        <option value="5" {{ ($pedido->status == 5) ? 'selected' : '' }} data-icon="fa fa-circle text-info">Pedido em separação</option>
                                                        <option value="6" {{ ($pedido->status == 6) ? 'selected' : '' }} data-icon="fa fa-circle text-success">Pedido Enviado</option>
                                                        <option value="7" {{ ($pedido->status == 7) ? 'selected' : '' }} data-icon="fa fa-circle text-success">Pedido Entregue</option>
                                                        <option value="8" {{ ($pedido->status == 8) ? 'selected' : '' }} data-icon="fa fa-circle text-success">Pedido pronto para retirada</option>
                                                        <option value="9" {{ ($pedido->status == 9) ? 'selected' : '' }} data-icon="fa fa-circle text-info">Pagamento devolvido</option>
                                                        <option value="10" {{ ($pedido->status == 10) ? 'selected' : '' }} data-icon="fa fa-circle text-danger">Pedido Cancelado</option>
                                                    </select>
                                                </div>
                                                @if($pedido->status != 10)
                                                <div class="col-md-4">
                                                    <label>&nbsp;</label><br />
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Alterar Situação
                                                    </button>
                                                </div>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="well" style="padding:28px 15px;">
                                        <a class="btn btn-success waves-effect waves-light btn-block btn-lg" href="{{ url('admin/pedido/'.$pedido->id.'/imprimir') }}" target="_blank">
                                            <i class="fa fa-print"></i> Imprimir Pedido
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="well">
                                        <h3>Pagamento</h3>

                                        @if($pedido->payment == 6)
                                            {{ \App\Pedidos::PAYMENT[$pedido->payment] }}<br />
											@php $totBoleto = (int) str_replace('.', '', $pedido->total) - (int) str_replace('.', '', $pedido->discount); @endphp
                                            <strong>@money($totBoleto, 'BRL')</strong> à vista<br />
											5% de desconto {!! ($pedido->status > 3 && $pedido->status != 10) ? '<span class="label label-success">Pago</span>' : '' !!}<br />

                                            @if($pedido->status <= 3)
                                                <a href="{{ $pedido->url_boleto }}" class="btn btn-primary btn-lg" target="_blank">Imprimir Boleto</a>
                                            @endif
                                        @elseif($pedido->payment == 7 || $pedido->payment == 14 || $pedido->payment == 21 || $pedido->payment == 22 || $pedido->payment == 23)
                                            {{ \App\Pedidos::PAYMENT[$pedido->payment] }}<br />
                                            <strong>@money($pedido->total, 'BRL')</strong> à vista {!! ($pedido->status > 3 && $pedido->status != 10) ? '<span class="label label-success">Pago</span>' : '' !!}<br />

                                            @if($pedido->status <= 3)
                                                <a href="{{ $pedido->url_boleto }}" class="btn btn-primary btn-lg" target="_blank">Pagar</a>
                                            @endif
                                        @else
                                            {{ \App\Pedidos::PAYMENT[$pedido->payment] }}<br />
                                            <strong>@money($pedido->total, 'BRL')</strong> em <strong>{{ $pedido->installment }}x</strong> de<br />
                                            <strong>@money(str_replace('.', '', $pedido->total) / $pedido->installment, 'BRL')</strong> Sem juros {!! ($pedido->status > 3 && $pedido->status != 10) ? '<span class="label label-success">Pago</span>' : '' !!}
                                        @endif
                                        {{--<strong>ID Stelo:</strong> {{ $pedido->id_stelo }}--}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="well">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h3>Envio via</h3>
                                                <p>{{ $pedido->ship_type }}</p>
                                            </div>
                                            <div class="col-md-8">
                                                <form class="form-material form-horizontal" method="POST" action="{{ url('admin/pedido/'.$pedido->id.'/rastreamento/salvar') }}">
                                                    {{ csrf_field() }}

                                                    <div class="form-group">
                                                        <div class="col-md-10">
                                                            <label for="tracking">Rastreamento:</label>
                                                            <input type="text" class="form-control form-control-line" name="tracking" id="tracking" value="{{ $pedido->tracking or '' }}">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>&nbsp;</label><br />
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                                <i class="fa fa-check"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if($pedido->ship_prazo > 1)
                                                    <strong>Prazo de entrega:</strong> {{ $pedido->ship_prazo }} dias úteis após a confirmação do pagamento
                                                @else
                                                    <strong>Prazo de entrega:</strong> {{ $pedido->ship_prazo }} dia útil após a confirmação do pagamento
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="well">
                                        <h3>
                                            Cliente
                                            <a class="btn btn-info btn-rounded pull-right" style="font-size:12px" href="{{ url('admin/cliente/'.$pedido->id_user.'/detalhar') }}">Ver detalhes do cliente</a>
                                        </h3>
                                        <p>
                                            @php $user = \App\User::find($pedido->id_user); @endphp
                                            Nome: <span style="font-weight:500">{{ $user->name }}</span><br />
                                            Email: <span style="font-weight:500">{{ $user->email }}</span><br />
                                            @if(!empty($user->document == 'CPF'))
                                                CPF: <span style="font-weight:500">{{ $user->cpf }}</span><br />
                                            @else
                                                CNPJ: <span style="font-weight:500">{{ $user->cnpj }}</span><br />
                                                Insc. Est.: <span style="font-weight:500">{{ $user->insc_estadual }}</span><br />
                                                Razão Social: <span style="font-weight:500">{{ $user->razao_social }}</span><br />
                                            @endif
                                            @if(!empty($user->genre))
                                                Sexo: <span style="font-weight:500">{{ ($user->genre == 'M') ? 'Masculino' : 'Feminino' }}</span><br />
                                            @endif
                                            @if(!empty($user->cell))
                                                Celular: <span style="font-weight:500">{{ $user->cell }}</span><br />
                                            @endif
                                            @if(!empty($user->phone))
                                                Telefone Fixo: <span style="font-weight:500">{{ $user->phone }}</span><br />
                                            @endif
                                            @if(!empty($user->data_nasc) && $user->data_nasc != '0000-00-00')
                                                Data Nascimento: <span style="font-weight:500">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $user->data_nasc)->format('d/m/Y') }}</span><br />
                                            @endif
                                        </p>

                                        <hr>

                                        <h3>Endereço de entrega</h3>
                                        <p>
                                            @php $endereco = \App\UsersAddress::find($pedido->id_address); @endphp
                                            <strong>{{ $endereco->nome }}</strong><br />
                                            @if($endereco->tipo == 'APTO')
                                                APARTAMENTO<br />
                                            @elseif($endereco->tipo == 'CASA')
                                                CASA<br />
                                            @elseif($endereco->tipo == 'COM')
                                                COMERCIAL<br />
                                            @elseif($endereco->tipo == 'OUTRO')
                                                {{ strtoupper($endereco->qual) }}<br />
                                            @endif
                                            {{ $endereco->endereco }}{{ ($endereco->numero) ? ', '.$endereco->numero : '' }}{{ ($endereco->complemento) ? ' - '.$endereco->complemento : '' }}<br />
                                            {{ $endereco->bairro }}<br />
                                            {{ $endereco->cidade }} - {{ $endereco->estado }}<br />
                                            {{ $endereco->cep }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <div class="well">
                                        <h3>Produtos</h3>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th width="100" class="text-right">Valor Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach(\App\PedidosProdutos::where('id_order', $pedido->id)->get() as $fProd)
                                                    @php
                                                        $nameProd = \App\Produtos::getNameProduct($fProd->id_product);
                                                        $idParentProd = \App\Produtos::select('id_parent')->where('id', $fProd->id_product)->first();
                                                    @endphp
                                                <tr class="v-a-middle">
                                                    <td>
                                                        @if(is_null(\App\ProdutosImagens::getImage($fProd->id_product)))
                                                            @if(is_null(\App\ProdutosImagens::getImage($idParentProd->id_parent)))
                                                                <div class="no-image-cart">
                                                                    <div class="center-items">
                                                                        <i class="dl-logo"></i><br />
                                                                        <span>Sem imagem</span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <img src="{{ asset(\App\ProdutosImagens::getImage($idParentProd->id_parent)) }}" alt="{{ $nameProd }}" class="pull-left m-r-10" style="height:90px;">
                                                            @endif
                                                        @else
                                                            <img src="{{ asset(\App\ProdutosImagens::getImage($fProd->id_product)) }}" alt="{{ $nameProd }}" class="pull-left m-r-10" style="height:90px;">
                                                        @endif
                                                        <strong>{{ $nameProd }}</strong><br />
                                                        <strong>REF:</strong> {{ \App\Produtos::getSku($fProd->id_product) }}
                                                    </td>
                                                    <td class="text-right">
                                                        @php
                                                            $price_total = $fProd->price * $fProd->qty;
                                                        @endphp
                                                        @money(number_format($price_total, 2,".",","), 'BRL')<br />
                                                        Qtd. <div class="label label-primary">{{ $fProd->qty }}</div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @if($cupon != null)
                                                <tr>
                                                    <td class="text-right" width="50%"> <strong>Cupom de desconto: </strong></td>
                                                    <td class="text-right text-danger" width="50%"> {{ $cupon->code }} - {{ $cupon->type_coupon == 'PORC' ? $cupon->value.'%' : 'R$'.$cupon->value }} </td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td class="text-right">
                                                        <strong>Entrega {{ $pedido->ship_type }}:</strong>
                                                    </td>
                                                    <td class="text-right">
                                                        @money($pedido->ship_price, 'BRL')
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right">
                                                        <strong>Total:</strong>
                                                    </td>
                                                    <td class="text-right">
														@if($pedido->payment == 6)
															@php $totBoleto = (int) str_replace('.', '', $pedido->total) - (int) str_replace('.', '', $pedido->discount); @endphp
															@money($totBoleto, 'BRL')<br />
															<small>5% de desconto</small>
														@else
															@money($pedido->total, 'BRL')
														@endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Observações internas
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            @foreach($observations as $obs)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="well">
                                        <h3 class="p-t-0">
                                            {{ $obs->user_name }}
                                            @if(($obs->send_client))
                                                <div class="label label-success"><i class="fa fa-check"></i> Enviado para o cliente</div>
                                            @endif

                                            <span class="pull-right">
                                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $obs->created_at)->format('d/m/Y H:i') }}
                                            </span>
                                        </h3>
                                        <hr class="m-t-0">
                                        <p>{{ $obs->observation }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <form class="form-material form-horizontal" role="form" method="POST" action="{{ url('admin/pedido/'. $pedido->id .'/observation/salvar') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="user_name" value="{{ Auth::guard('admins')->user()->name }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea class="form-control form-control-line" rows="5" name="observation" id="observation" placeholder="Digite uma observação para gerenciamento interno ou envie uma mensagem para o cliente."></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Salvar observação</button>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="checkbox checkbox-primary">
                                            <input id="checkbox2" type="checkbox" name="enviar_email" value="1">
                                            <label for="checkbox2"> Enviar esta observação via e-mail para o cliente </label>
                                        </div>
                                    </div>
                                </div>
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
                        {{--Histórico do pedido--}}
                    {{--</div>--}}

                    {{--<div class="panel-wrapper collapse in">--}}
                        {{--<table class="table table-striped">--}}
                            {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Data</th>--}}
                                    {{--<th>Situação</th>--}}
                                    {{--<th>Alterado por</th>--}}
                                {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td>28/04/2017 17:34</td>--}}
                                    {{--<td>Pedido Efetuado</td>--}}
                                    {{--<td>Nei Barros (cliente)</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>28/04/2017 17:39</td>--}}
                                    {{--<td>Pedido Pago</td>--}}
                                    {{--<td>Nei Barros (usuario)</td>--}}
                                {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
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
