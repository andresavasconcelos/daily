@extends('emails.layouts.site')

@section('content_site_email')
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
                                <td align="center" style="padding-top:25px; padding-bottom:20px">
                                    <span style="font-family: 'Open Sans', Arial, Helvetica, sans-serif, serif, EmojiFont; font-size: 34px; font-weight: bold; color: rgb(0, 0, 0); text-align: center;">
                                        <b style="font-family:'Open Sans',sans-serif">novo avise-me</b>
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
                            Um novo Avise-me foi solicitado via site.
                        </p>
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.4em">
                            <b>Produto:</b> {{ $avise->nome_produto }}
                        </p>
                        <p style="font-family:'Open Sans',sans-serif; font-size:13px; color:#000; line-height:1.4em">
                            <b>Nome:</b> {{ $avise->nome }}<br />
                            <b>E-mail:</b> {{ $avise->email }}
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
@endsection