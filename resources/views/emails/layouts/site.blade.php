<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>fautriz</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="margin:0;padding:0;">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="table-layout:fixed; background-color:#ffffff">
            <tbody>
            <tr>
                <td align="center">
                    <table cellpadding="0" cellspacing="0" border="0" align="center" width="650"
                           class="x_m_-4538126951018225067container" style="width:100%; max-width:650px">
                        <tbody>
                        <tr>
                            <td>
                                <table align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="width:100%">
                                    <tbody>
                                    <tr>
                                        <td align="center" style="padding-top:14px; padding-bottom:20px">
                                            <img src="{{ asset('images/logo1.png') }}" alt="" border="0" align="center" width="175" style="display:block">
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

            @yield('content_site_email')

            <tr>
                <td align="center">
                    <table align="center" width="650" cellpadding="0" cellspacing="20" bgcolor="#ebebeb"
                           style="max-width:650px; width:100%">
                        <tbody>
                        <tr>
                            <td>
                                <p align="justify" style="font-family:'Open Sans',sans-serif; font-size:9px; color:black">
                                    Este e-mail é enviado por um sistema automático, não responda diretamente.
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </body>
</html>