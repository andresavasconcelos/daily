<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>
<table border="0" cellpadding="0" cellspacing="0" width="600">
    <tbody>
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                <tr align="center">
                    <td style=" border:none; background-color: #FF9D00;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;" target="_blank" >
                        <img src="{{ url('/images/logo.png') }}" alt="Empreenda" style="display:block;max-width:580px;">
                        <!--<a href="#urlbase#/" style="border:none;" target="_blank">-->
                        <!--<img src="#urlbase#/images/logo_email.jpg" alt="Empreenda Revista" style="display:block;max-width:580px;">-->
                        <!--</a>-->
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center" valign="top">
            <table border="0" bgcolor="#000" cellpadding="0" cellspacing="0" width="100%" height="5" style="font-family: Open Sans,Helvetica,Arial,sans-serif;">
                <tbody>
                <tr>
                    <td align="right"></td>
                </tr>
                </tbody>
            </table>

            <table border="0" bgcolor="#FFFFFF" cellpadding="10" cellspacing="15" width="100%" style="font-family: Open Sans,Helvetica,Arial,sans-serif;border-left:1px solid #CCC;border-right:1px solid #CCC;border-bottom:1px solid #CCC;">
                <tbody>
                <tr>
                    <td align="left" valign="bottom">
                        <h1 style="font-family: Open Sans,Helvetica,Arial,sans-serif;font-weight:800;font-size:28px;color:#000;margin-bottom:0px;text-transform:uppercase;">Nova assinatura realizada no site!</h1>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" style="font-size:14px;color:#696969;font-family: Open Sans,Helvetica,Arial,sans-serif;">
                        <p>Nome: {{ $cliente->name }}</p>
                        <p>Email: {{ $cliente->email }}</p>
                        <p>Celular: {{ $cliente->celular }}</p>
                        <p>Telefone: {{ $cliente->telefone }}</p>
                        <p>Cep: {{ $cliente->cep }}</p>
                        <p>Endereço: {{ $cliente->address }}</p>
                        @if($cliente->complemento != '' && $cliente->complemento != null)
                        <p>Complemento: {{ $cliente->complemento }}</p>
                        @endif

                        @if($cliente->referencia != '' && $cliente->referencia != null)
                        <p>Referência: {{ $cliente->referencia }}</p>
                        @endif

                        <p>Numero: {{ $cliente->numero }}</p>
                        <p>Estado: {{ $cliente->estado }}</p>
                        <p>Cidade: {{ $cliente->cidade }}</p>
                        <p>Bairro: {{ $cliente->bairro }}</p>
                        <br />
                        <p>A assinatura escolhida foi {{ $produto->nome }}.</p>
                        <p>Código da assinatura {{ $assinatura->codigo_assinatura }}.</p>
                    </td>
                </tr>
                </tbody>
            </table>

            <table border="0" bgcolor="#FFFFFF" cellpadding="10" cellspacing="15" width="100%" style="font-family: Open Sans,Helvetica,Arial,sans-serif;">
                <tbody>
                <!--<tr>-->
                <!--<div align="center" valign="top" style="font-size:11px;color:#696969;font-family: Open Sans,Helvetica,Arial,sans-serif;">-->
                <!--&lt;!&ndash;<a href="http://empreendarevista.com.br">Acesse o Site</a>&ndash;&gt;-->
                <!--<a href="http://empreendarevista.com.br">Acesse o Site</a>-->
                <!--</div>-->
                <!--</tr>-->
                <tr>
                    <td align="center" valign="top" style="font-size:11px;color:#696969;font-family: Open Sans,Helvetica,Arial,sans-serif;">
                        <p>Esta mensagem foi enviada por um sistema automático. Por favor, não responda a este e-mail diretamente.</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>