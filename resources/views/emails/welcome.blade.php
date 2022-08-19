@extends('emails.layout')

@section('content_page')

<table class="es-content" cellspacing="0" cellpadding="0" align="center"
    style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%">
    <tr style="border-collapse:collapse">
        <td align="center" style="padding:0;Margin:0">
            <table class="es-content-body"
                style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"
                cellspacing="0" cellpadding="0" align="center">
                <tr style="border-collapse:collapse">
                    <td align="left" style="padding:0;Margin:0">
                        <table width="100%" cellspacing="0" cellpadding="0"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                            <tr style="border-collapse:collapse">
                                <td valign="top" align="center" style="padding:0;Margin:0;width:600px">
                                    <table
                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:3px;background-color:#FCFCFC"
                                        width="100%" cellspacing="0" cellpadding="0" bgcolor="#fcfcfc"
                                        role="presentation">
                                        <tr style="border-collapse:collapse">
                                            <td class="es-m-txt-l" align="left"
                                                style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-top:15px">
                                                <h2
                                                    style="text-align:center;Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#333333">
                                                    ¡Bienvenido!</h2>
                                            </td>
                                        </tr>
                                        <tr style="border-collapse:collapse">
                                            <td bgcolor="#fcfcfc" align="left"
                                                style="padding:0;Margin:0;padding-top:10px;padding-left:20px;padding-right:20px">
                                                <p
                                                    style="text-align: justify;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:21px;color:#333333">
                                                    Hola,&nbsp;{{$user->name}}, estamos
                                                    contentos de que esté aquí.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr style="border-collapse:collapse">
                    <td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;background-color:#FCFCFC"
                        bgcolor="#fcfcfc" align="left">
                        <table width="100%" cellspacing="0" cellpadding="0"
                            style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px">
                            <tr style="border-collapse:collapse">
                                <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                    <table
                                        style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-color:#EFEFEF;border-style:solid;border-width:1px;border-radius:3px;background-color:#FFFFFF"
                                        width="100%" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                                        role="presentation">
                                        <tr style="border-collapse:collapse">
                                            <td align="rigth"
                                                style="padding:0;Margin:0;padding-bottom:15px;padding-top:20px;">
                                                <h3
                                                    style="text-align:center;Margin:0;line-height:22px;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:18px;font-style:normal;font-weight:normal;color:#333333">
                                                    La información de su cuenta:</h3>
                                            </td>
                                        </tr>
                                        <tr style="border-collapse:collapse">
                                            <td align="center" style="padding:0;Margin:0">
                                                <p
                                                    style="text-align:center;Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:16px;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;line-height:24px;color:#0E60A6">
                                                    Email: {{$user->email}}</p>
                                            </td>
                                        </tr>
                                        <tr style="border-collapse:collapse">
                                            <td align="center"
                                                style="Margin:0;padding-left:10px;padding-right:10px;padding-top:20px;padding-bottom:20px">
                                                <span class="es-button-border"
                                                    style="border-style:solid;border-color:transparent;background:#F8F3EF none repeat scroll 0% 0%;border-width:0px;display:inline-block;border-radius:3px;width:auto"><a
                                                        href="{{url('home')}}" class="es-button" target="_blank"
                                                        style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:roboto, 'helvetica neue', helvetica, arial, sans-serif;font-size:17px;color:white;border-style:solid;border-color:#0e60a6;border-width:10px 20px 10px 20px;display:inline-block;background:#0e60a6 none repeat scroll 0% 0%;border-radius:3px;font-weight:normal;font-style:normal;line-height:20px;width:auto;text-align:center">
                                                        Ir al inicio</a>
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

@endsection