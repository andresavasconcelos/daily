@extends('emails.layouts.email')

@section('header_email')
    <tr>
        <td>
            <table align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width:100%">
                <tbody>
                <tr>
                    <td>
                        <table align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width:100%">
                            <tbody>
                            <tr>
                                <td align="center" style="padding-top:40px">
                                    <img src="{{ asset('images/email-images/pedido-entregue.jpg') }}">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-top:25px; padding-bottom:20px">
                                    <span style="font-family: 'Open Sans', Arial, Helvetica, sans-serif, serif, EmojiFont; font-size: 34px; font-weight: bold; color: rgb(0, 0, 0); text-align: center;">
                                        <b style="font-family:'Open Sans',sans-serif">pedido entregue</b>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection

@section('content_email')
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" border="0" align="center" width="650"
                   class="x_m_-4538126951018225067container" bgcolor="#FFFFFF" style="width:100%; max-width:650px">
                <tbody>
                <tr>
                    <td align="center" class="x_m_-4538126951018225067m-sides-padding" style="padding-left:45px; padding-right:45px; padding-top:20px; padding-bottom:15px">
                        <p style="font-family:'Open Sans',sans-serif; font-size:16px; color:#000; line-height:1.4em; margin-bottom:0.3em">
                            Olá, {{ $user->name }}!
                        </p>
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.4em">
                            Que ótima notícia! Recebemos a confirmação de entrega do seu pedido <b>{{ $order->order_number }}</b>.<br />
                            Agradecemos por ter escolhido a fautriz! :)
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="padding-bottom:20px">
                        <img src="{{ asset('images/email-images/pedido-entregue_timeline.jpg') }}" alt="" border="0" width="382" height="40" style="display:block">
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" bgcolor="#f7f7f7" style="padding-left:45px; padding-right:45px; padding-bottom:18px; padding-top:18px">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#f7f7f7" style="width:100%; max-width:555px">
                            <tbody>
                            <tr>
                                <td valign="top" align="center">
                                    <table width="50%" cellpadding="0" cellspacing="0" border="0" align="center" style="max-width:555px">
                                        <tbody>
                                        <tr>
                                            <td align="center">
                                                <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; font-weight:bold; text-transform:uppercase; line-height:1.4em">
                                                    <b>Endereço de entrega </b>
                                                </p>
                                                <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.4em">
                                                    {{ $address->nome }}<br>
                                                    {{ $address->endereco }}{{ ($address->numero) ? ' - '.$address->numero : '' }}{{ ($address->complemento) ? ' - '.$address->complemento : '' }} - {{ $address->bairro }}<br>
                                                    {{ $address->cidade }} - {{ $address->estado }}<br>
                                                    {{ $address->cep }}<br>
                                                </p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#FFFFFF" style="width:100%; max-width:555px">
                            <tbody>
                            <tr class="x_m_-4538126951018225067m-full">
                                <td align="center" style="padding-top:35px">
                                    <p style="font-family:'Open Sans',sans-serif; font-weight:bold; font-size:13px; color:#8a0505">
                                        Entrega em até {{ $order->ship_prazo }} dias úteis<br><br>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-left:45px; padding-right:45px; padding-bottom:15px">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#FFFFFF" style="width:100%; max-width:555px">
                            <tbody>
                            <tr class="x_m_-4538126951018225067m-full">
                                <td align="center" style="padding-top:20px">
                                    <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; font-weight:bold; text-transform:uppercase">
                                        <b>Confira abaixo o que entregamos</b>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-top:10px; padding-left:45px; padding-right:45px">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#FFFFFF" style="width:100%; max-width:555px">
                            <tbody>
                            <tr>
                                <td style="padding-top:20px; padding-bottom:20px">
                                    <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#FFFFFF" style="width:100%; max-width:555px">
                                        <tbody>
                                        <tr>
                                            <td valign="top" align="left">
                                                <table align="left" class="x_m_-4538126951018225067m-full" width="50%" cellpadding="0" cellspacing="0">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center">
                                                            <img src="{{ asset('images/email-images/icon_cesta.jpg') }}">
                                                            <br>
                                                            <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000; line-height:1.5em; margin-top:10px">
                                                                <span style="font-size: 14px; font-weight: bold; color: #8a0505; font-family: 'Open Sans', sans-serif, serif, EmojiFont;">Pedido nº {{ $order->order_number }}</span>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <table align="left" class="x_m_-4538126951018225067m-full" width="50%" cellpadding="0" cellspacing="0" style="margin-bottom:10px">
                                                    <tbody>
                                                    <tr>
                                                        <td align="center">
                                                            <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; font-weight:bold; text-transform:uppercase">
                                                                <b>Forma de pagamento</b>
                                                            </p>
                                                            <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000; line-height:1.4em">
                                                                {{ $order->order_number }}<br>
                                                                @if($order->payment == 6)
                                                                    Boleto Bancário<br />
                                                                    @money(str_replace('.', '', $order->total), 'BRL') (à vista)<br>
                                                                @elseif($order->payment == 7 || $order->payment == 14 || $order->payment == 21 || $order->payment == 22 || $order->payment == 23)
                                                                    Transferência Online<br />
                                                                    @money(str_replace('.', '', $order->total), 'BRL') (à vista)<br>
                                                                @else
                                                                    Cartão de Crédito<br />
                                                                    @money(str_replace('.', '', $order->total), 'BRL') (em {{ $order->installment }}x)<br>
                                                                @endif
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-left:45px; padding-right:45px; padding-bottom:5px">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#FFFFFF" style="width:100%; max-width:557px">
                            <tbody>
                            @php $orderProds = \App\PedidosProdutos::where('id_order', $order->id)->get(); @endphp
                            @foreach($orderProds as $prod)
                                @php $produto = \App\Produtos::findOrFail($prod->id_product); @endphp
                                <tr>
                                    <td align="left" width="73" style="padding:5px 0; border-bottom:1px solid #e6e6e6; border-left:1px solid #e6e6e6; border-top:1px solid #e6e6e6">
                                        @if(is_null(\App\ProdutosImagens::getImage($produto->id)))
                                            @if(is_null(\App\ProdutosImagens::getImage($produto->id_parent)))
                                                Sem imagem
                                            @else
                                                <img src="{{ asset(\App\ProdutosImagens::getImage($produto->id_parent)) }}" alt="{{ $produto->name }}" width="70" style="width: 70px;">
                                            @endif
                                        @else
                                            <img src="{{ asset(\App\ProdutosImagens::getImage($produto->id)) }}" alt="{{ $produto->name }}" width="70" style="width: 70px;">
                                        @endif
                                    </td>
                                    <td align="left" valign="middle" style="padding-left:10px; padding-bottom:10px; padding-top:10px; border-bottom:1px solid #e6e6e6; border-top:1px solid #e6e6e6">
                                        <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                            {{ $produto->name }}<br>
                                            Tipo de entrega: <b>{{ $order->ship_type }}</b><br><br>
                                        </p>
                                    </td>
                                    <td align="right" valign="middle" style="padding-right:15px; border-bottom:1px solid #e6e6e6; border-right:1px solid #e6e6e6; border-top:1px solid #e6e6e6">
                                        <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                            {{ $prod->qty }}x @money(str_replace('.', '', $prod->price) * $prod->qty, 'BRL')
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-left:45px; padding-right:45px; padding-bottom:5px; padding-top:10px">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#FFFFFF" style="width:100%; max-width:555px">
                            <tbody>
                            <tr>
                                <td>
                                    <table align="left">
                                        <tbody>
                                        <tr>
                                            <td><a href="{{ url('minha-conta/pedidos') }}" target="_blank" rel="noopener noreferrer">
                                                    <img src="{{ asset('images/email-images/btn-acompahe-pedido-emkt.jpg') }}" alt="acompanhe seu pedido"></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table align="right" bgcolor="#FFFFFF" style="background:#fff; margin-bottom:15px; border:1px solid #e6e6e6">
                                        <tbody>
                                            <tr>
                                                <td valign="top" align="right" style="padding-top:7px; padding-bottom:7px; padding-left:7px; padding-right:7px">
                                                    <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                                        Subtotal
                                                    </p>
                                                </td>
                                                <td valign="top" align="right" style="padding-top:7px; padding-bottom:7px; padding-left:7px; padding-right:7px">
                                                    <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                                        @money(str_replace('.', '', $order->subtotal))
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="right" style="padding-top:7px; padding-bottom:7px; padding-left:7px; padding-right:7px">
                                                    <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                                        Frete {{ $order->ship_type }}
                                                    </p>
                                                </td>
                                                <td valign="top" align="right" style="padding-top:7px; padding-bottom:7px; padding-left:7px; padding-right:7px">
                                                    <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                                        @money(str_replace('.', '', $order->ship_price))
                                                    </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="right" style="padding-top:7px; padding-bottom:7px; padding-left:7px; padding-right:7px">
                                                    <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                                        Total
                                                    </p>
                                                </td>
                                                <td valign="top" align="right" style="padding-top:7px; padding-bottom:7px; padding-left:7px; padding-right:7px">
                                                    <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000000; line-height:1.4em">
                                                        @money(str_replace('.', '', $order->total))
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-left:25px; padding-right:25px; padding-bottom:5px; padding-top:10px">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" class="x_m_-4538126951018225067container" bgcolor="#f7f7f7" style="width:100%; max-width:600px">
                            <tbody>
                            <tr>
                                <td style="padding:20px">
                                    <p style="font-family:'Open Sans',sans-serif; font-size:14px; color:#000; line-height:1.4em; margin-bottom:1.4em">
                                        <b>Fique de olho:</b>
                                    </p>
                                    <p style="font-family:'Open Sans',sans-serif; font-size:12px; color:#000; line-height:1.4em">
                                        - Todos os pedidos estão sujeitos à liberação do crédito e disponibilidade do produto no estoque. Caso a entrega não esteja disponível, nosso “Fale Conosco” vai entrar em contato com você por telefone ou e-mail;<br><br>
                                        - Mantenha sempre seus dados de cadastro completos e atualizados. Se for necessário, a gente falará com você, para garantir a entrega da sua encomenda com segurança; <br><br>
                                        - Nosso prazo para confirmar o pagamento é de até 2 (dois) dias úteis para compras via cartão e para transações por boleto. <b>Vamos enviar para você um e-mail informando que a compra foi realizada com sucesso e o prazo de entrega do produto;</b><br><br>
                                        - Você pode acompanhar o andamento do seu pedido <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer" style="color:#8a0505; font-weight:bold; text-decoration:none">pelo site</a>, também na aba <a href="{{ url('minha-conta/pedidos') }}" target="_blank" rel="noopener noreferrer" style="color:#8a0505; font-weight:bold; text-decoration:none">“Meus Pedidos”</a>.<br><br>
                                        - Guarde este e-mail até a entrega dos produtos;<br><br> Por favor, não responda este e-mail. Ele foi gerado automaticamente.<br>
                                    </p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-right:25px; padding-bottom:5px; padding-top:10px; padding-left:25px">
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.2em">
                            Ah e lembre-se que nós sempre temos novidades
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-right:25px; padding-bottom:5px; padding-top:10px; padding-left:25px">
                        <p style="font-family:'Open Sans',sans-serif; font-size:17px; color:#8a0505; line-height:1.2em; margin-bottom:1.2em">
                            <b>Até a próxima!<br> Equipe fautriz</b>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection