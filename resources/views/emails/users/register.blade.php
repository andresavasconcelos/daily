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
                                    <img src="{{ asset('images/email-images/cadastro.jpg') }}">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="padding-top:25px; padding-bottom:20px">
                                    <span style="font-family: 'Open Sans', Arial, Helvetica, sans-serif, serif, EmojiFont; font-size: 34px; font-weight: bold; color: rgb(0, 0, 0); text-align: center;">
                                        <b style="font-family:'Open Sans',sans-serif">obrigado por se cadastrar</b>
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
                            Olá, {{ $user->name }}! Tudo bem?
                        </p>
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.4em">
                            O cadastro em nosso site foi realizado com sucesso.<br>
                            É muito bom ter você com a gente!
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