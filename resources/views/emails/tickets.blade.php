<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Event Ticket | Urband Music</title>
</head>

<body>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="width:100%!important;table-layout:fixed"
        bgcolor="#ffffff">
        <tbody>
            <tr>
                <td valign="top" align="center">
                    <div class="" style="min-width:820px;margin:0 auto" align="center">
                        <table bgcolor="#121217" width="800" border="0" cellpadding="0" cellspacing="0"
                            style="width:800px;margin:0 auto;border:solid 1px #e3e7ec;border-bottom:0;padding-top:20px;padding-bottom:20px;">
                            <tbody>
                                <tr>
                                    <td align="center">
                                        <table bgcolor="#121217" width="610" border="0" cellpadding="0" cellspacing="0"
                                            style="width:610px;margin:0 auto;padding:0">
                                            <tbody>
                                                <tr>
                                                    <td dir="ltr">

                                                        <img class=""
                                                            src="https://www.urbandmusic.com/logo.png"
                                                            alt="Urband Music" width="150" border="0"
                                                            style="display:block;border:none;margin: 0 auto;">

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table dir="rtl" bgcolor="#121217" width="610" border="0" cellpadding="0"
                                            cellspacing="0" style="width:610px;margin:0 auto;padding:0">

                                            <tbody>
                                                <tr>

                                                    <td dir="ltr" align="center" valign="middle" width="100%"
                                                        style="vertical-align:middle">
                                                        <h1
                                                            style="font-family:'Proxima Nova','Open Sans',Corbel,Arial,sans-serif;font-weight:600;color:#fff;letter-spacing:-0.4px;margin-top:30px;margin-bottom:31px;font-size:33px;line-height:35.52px">

                                                            Your Ticket To - {{$address->event->title}}.

                                                        </h1>

                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>



                        <table width="800" border="0" cellpadding="0" cellspacing="0"
                            style="width:800px;margin:0 auto;border:solid 1px #e3e7ec;border-top:0;border-bottom:0;padding-top:35px;padding-bottom:35px">
                            <tbody>
                                <tr>
                                    <td align="center" dir="ltr">
                                        <table width="610" border="0" cellpadding="0" cellspacing="0"
                                            style="width:610px;margin:0 auto;padding:0">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:5px">
                                                        <h3
                                                            style="font-family:'Proxima Nova','Open Sans',Corbel,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:1.24;letter-spacing:-0.1px;color:#f60038;margin:0">

                                                            Hala {{$user->name}},

                                                        </h3>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:5px">
                                                        <p
                                                            style="font-family:'Proxima Nova','Open Sans',Corbel,Arial,sans-serif;font-size:17px;line-height:1.62;color:#404553;letter-spacing:normal">
                                                            YOUR TICKET. <br>
                                                            Booking ID: <strong style="font-family:'Proxima Nova','Open Sans',Corbel,Arial,sans-serif;font-size:22px;line-height:1.62;color:#404553;letter-spacing:normal">{{$address->booking_id}}</strong><br>
                                                            <img src="{!!$message->embedData($qr, 'QrCode.png', 'image/png')!!}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:9px 5px">
                                                        <p
                                                            style="font-family:'Proxima Nova','Open Sans',Corbel,Arial,sans-serif;font-size:13px;line-height:1.62;color:#404553;letter-spacing:normal">

                                                        </p>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" dir="ltr" style="padding-top:25px;padding-bottom:0">

                                    </td>
                                </tr>



                                <tr>
                                    <td align="center" dir="ltr">
                                        <table width="610" border="0" cellpadding="0" cellspacing="0"
                                            style="width:610px;margin:0 auto;padding:0">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:18px 5px 0 5px">
                                                        <p
                                                            style="font-family:'Proxima Nova','Open Sans',Corbel,Arial,sans-serif;font-size:14px;font-weight:600;line-height:1.4;color:#4a4a4a">
                                                            Shukran,<br>The Urband Music team</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                        <table bgcolor="#121217" width="800" border="0" cellpadding="0" cellspacing="0"
                            style="width:800px;margin:0 auto;border:solid 1px #e3e7ec;border-top:0;padding-top:5px;padding-bottom:5px">
                            <tbody>
                                <tr>
                                    <td align="center" dir="ltr" style="background-color: #121217">
                                        <table width="610" cellpadding="0" cellspacing="0"
                                            style="box-sizing:border-box;width:610px;margin:0 auto;padding:0 5px">
                                            <tbody>
                                                <tr>
                                                    <td align="center" dir="ltr">
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            style="width:610px;margin:0 auto;padding:10px 0 10px 0">
                                                            <tbody>
                                                                <tr>
                                                                    <td dir="ltr">

                                                                        <img class=""
                                                                            src="https://www.urbandmusic.com/logo.png"
                                                                            alt="Urband Music" width="40" border="0"
                                                                            style="display:block;border:none;margin: 0 auto; filter: grayscale(100%);-webkit-filter: grayscale(100%);opacity:0.77">

                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td width="60%"
                                                                        style="padding:8px;font-family:'Proxima Nova','Open Sans',Corbel,Arial,sans-serif;font-size:10px;line-height:18px;letter-spacing:0.3px;text-align:center;color:#fff">
                                                                        {{date('Y')}} <a href="https://www.urbandmusic.com/" style="color:#fff">Urband Music</a>
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
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
