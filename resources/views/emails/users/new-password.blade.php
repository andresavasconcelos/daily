@extends('emails.layouts.email')

@section('header_email')
    <tr>
        <td>
            <table align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width:100%">
                <tbody>
                <tr>
                    <td class="x_m_-4538126951018225067hidemobile x_m_-4538126951018225067m-hide" align="left" valign="top">
                        <img src="{{ asset('images/email-images/graphleft_2.jpg') }}" alt="" border="0" style="display:block">
                    </td>
                    <td>
                        <table align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width:100%">
                            <tbody>
                            <tr>
                                <td align="center" style="padding-top:40px">
                                    <img src="{{ asset('images/email-images/nova-senha.jpg') }}">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-top:25px; padding-bottom:20px">
                                    <span style="font-family: 'Open Sans', Arial, Helvetica, sans-serif, serif, EmojiFont; font-size: 34px; font-weight: bold; color: rgb(0, 0, 0); text-align: center;">
                                        <b style="font-family:'Open Sans',sans-serif">recupere sua senha</b>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="x_m_-4538126951018225067hidemobile x_m_-4538126951018225067m-hide" align="right" valign="bottom">
                        <img src="{{ asset('images/email-images/graphright_2.jpg') }}" alt="" border="0" style="display:block">
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
                            Olá,
                        </p>
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.4em">
                            Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta.
                        </p>
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.4em">
                            Se você não solicitou a troca da senha, nenhuma ação adicional é necessária.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="x_m_-4538126951018225067m-sides-padding" style="padding-left:45px; padding-right:45px; padding-top:20px; padding-bottom:15px">
                        <a href="{{ route('password.reset', $token) }}" target="_blank" style="border: 0; border-radius: 0; background-color: #8a0505; padding: 10px 15px; font-family:'Open Sans',sans-serif; font-size:13px; color:#FFFFFF; line-height:1.4em">Resetar a senha</a>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-right:25px; padding-bottom:5px; padding-top:10px; padding-left:25px">
                        <p style="font-family:'Open Sans',sans-serif; font-size:10px; color:#000; line-height:1.2em">
                            Se você estiver tendo problemas para clicar no botão "Resetar a senha", copie e cole o URL abaixo em seu navegador:
                            <a href="{{ route('password.reset', $token) }}" target="_blank">{{ route('password.reset', $token) }}</a>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="x_m_-4538126951018225067m-sides-padding" style="padding-right:25px; padding-bottom:5px; padding-top:10px; padding-left:25px">
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.2em">
                            Por favor, não responda este e-mail. Ele foi gerado automaticamente.
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