@extends('admin.layouts.print')

@section('title', 'Impressão pedido '.$pedido->order_number)

@section('content')
    <div id="globalContainerPrint">
        <div class="container">

            <div class="page-break">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="etiqueta">
                            <img src="{{ asset('images/scissor.jpg') }}" class="tesoura" />

                            <p>
                                <strong class="tit">REMETENTE:</strong>
                                <strong>fautriz</strong><br/>
                                Rua Paraíba, 291<br />
                                Centro<br />
                                São Caetano do Sul - SP<br/>
                                <strong>CEP: 09521-070</strong>&nbsp;&nbsp;BR
                            </p>
                        </div>
                    </div>

                    <div class="col-xs-6">
                        <div class="etiqueta">
                            <p>
                                <strong class="tit">DESTINATÁRIO:</strong>
                                @php $endereco = \App\UsersAddress::find($pedido->id_address); @endphp
                                <strong>{{ $endereco->nome }}</strong><br/>
                                {{ $endereco->endereco }}{{ ($endereco->numero) ? ', '.$endereco->numero : '' }}{{ ($endereco->complemento) ? ' - '.$endereco->complemento : '' }}<br />
                                {{ $endereco->bairro }}<br />
                                {{ $endereco->cidade }} - {{ $endereco->estado }}<br />
                                {{ $endereco->cep }}&nbsp;&nbsp;Brasil<br/>

                                <strong>Envio via: {{ $pedido->ship_type }}</strong>
                            </p>
                        </div>
                    </div>
                </div> <!-- .row -->
                <span class="linha-recorte"></span>
                <div class="recibo">
                    <div>
                        <div class="cabecalho">
                            <div class="row">
                                <div class="col-xs-6">

                                </div>
                                <div class="col-xs-6">
                                    <div class="info-empresa">
                                        <h3>Pedido de venda <strong>{{ $pedido->order_number }}</strong></h3>
                                        <p>Efetuado em: <strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pedido->created_at)->format('d/m/Y H:i') }}</strong></p>
                                        <p>Situação do pedido: <strong>{{ \App\Pedidos::STATUS_ORDER[$pedido->status] }}</strong></p>

                                        <p>Forma de pagamento: <strong>{{ \App\Pedidos::PAYMENT[$pedido->payment] }}</strong></p>
                                    </div>
                                </div>
                            </div><!-- .row -->
                        </div>
                        <div class="corpo">
                            <div class="row">

                                <div class="col-xs-6">
                                    @php $user = \App\User::find($pedido->id_user); @endphp
                                    <h4>Dados do cliente</h4>

                                    {{ $user->name }}<br />
                                    @if(!empty($user->document == 'CPF'))
                                        CPF: {{ $user->cpf }}<br />
                                    @else
                                        CNPJ: <span style="font-weight:500">{{ $user->cnpj }}</span><br />
                                        Insc. Est.: <span style="font-weight:500">{{ $user->insc_estadual }}</span><br />
                                        Razão Social: <span style="font-weight:500">{{ $user->razao_social }}</span><br />
                                    @endif
                                    Email: {{ $user->email }}<br />
                                    {{--@if(!empty($user->genre))--}}
                                        {{--Sexo: <span style="font-weight:500">{{ ($user->genre == 'M') ? 'Masculino' : 'Feminino' }}</span><br />--}}
                                    {{--@endif--}}
                                    @if(!empty($user->cell))
                                        Celular: <span style="font-weight:500">{{ $user->cell }}</span><br />
                                    @endif
                                    @if(!empty($user->phone))
                                        Telefone Fixo: <span style="font-weight:500">{{ $user->phone }}</span><br />
                                    @endif
                                    {{--@if(!empty($user->data_nasc) && $user->data_nasc != '0000-00-00')--}}
                                        {{--Data Nascimento: <span style="font-weight:500">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $user->data_nasc)->format('d/m/Y') }}</span><br />--}}
                                    {{--@endif--}}
                                </div>
                                <div class="col-xs-6 text-right">
                                    <p>
                                        <h4>Endereço de Entrega</h4>
                                        <strong>{{ $endereco->nome }}</strong><br/>
                                        {{ $endereco->endereco }}{{ ($endereco->numero) ? ', '.$endereco->numero : '' }}{{ ($endereco->complemento) ? ' - '.$endereco->complemento : '' }}<br />
                                        {{ $endereco->bairro }}<br />
                                        {{ $endereco->cidade }} - {{ $endereco->estado }}<br />
                                        {{ $endereco->cep }}&nbsp;&nbsp;Brasil<br/>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Produtos</h4>
                                <table class="table">
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th width="1%" style="white-space: nowrap;">Valor unitário</th>
                                        <th width="1%" style="white-space: nowrap;">Qtd.</th>
                                        <th width="1%" style="white-space: nowrap;">Valor total</th>
                                    </tr>
                                    <tr>
                                    @foreach(\App\PedidosProdutos::where('id_order', $pedido->id)->get() as $fProd)
                                        <tr class="v-a-middle">
                                            <td>
                                                {{ \App\Produtos::getSku($fProd->id_product) }}
                                            </td>
                                            <td>
                                                <strong>{{ \App\Produtos::getNameProduct($fProd->id_product) }}</strong>
                                            </td>
                                            <td style="white-space: nowrap; text-align: center;">@money($fProd->price, 'BRL')</td>
                                            <td style="text-align: center;">{{ $fProd->qty }}</td>
                                            @php $price_total = $fProd->price * $fProd->qty; @endphp
                                            <td style="white-space: nowrap; text-align: right;">@money(number_format($price_total, 2,".",","), 'BRL')</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-xs-5 pull-right">
                                <table class="table">
                                    <tr>
                                        <td style="text-align: right;">
                                            <strong>Subtotal:</strong>
                                        </td>
                                        <td style="text-align: right;">
                                            <strong>@money($pedido->subtotal, 'BRL')</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">
                                            <strong>Entrega {{ $pedido->ship_type }}:</strong>
                                        </td>
                                        <td style="text-align: right;">
                                            @money($pedido->ship_price, 'BRL')
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right;">
                                            <strong>Total:</strong>
                                        </td>
                                        <td style="text-align: right;">
											@if($pedido->payment == 6)
												@php $totBoleto = (int) str_replace('.', '', $pedido->total) - (int) str_replace('.', '', $pedido->discount); @endphp
												<strong>@money($totBoleto, 'BRL')</strong><br /><small>5% de desconto</small>
											@else
												<strong>@money($pedido->total, 'BRL')</strong>
											@endif
                                        </td>
                                    </tr>
                                </table>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container -->
@endsection
