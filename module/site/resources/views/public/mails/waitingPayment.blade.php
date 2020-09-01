<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <style type="text/css">
        /*RESET  -- this may be ignored by some email clients*/
        body{
        margin:0;
        padding:0;
        }
        img{
        border:0 none;
        height:auto;
        line-height:100%;
        outline:none;
        text-decoration:none;
        }
        a img{
        border:0 none;
        }
        .imageFix{
        display:block;
        }
        table, td{
        border-collapse:collapse;
        }
        #bodyTable{
        height:100% !important;
        margin:0;
        padding:0;
        width:100% !important;
        }
        /*END RESET*/
    </style>
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
        <tr>
            <td align="center" valign="top">
                <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailContainer">
                    <tr>
                        <td align="center" valign="top">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody">
                                <tr>
                                    <td align="center" valign="top">
                                        <!--MAIN CONTENT COPY-->
                                        <table border="0" cellpadding="0" cellspacing="0" width="600" style="text-align:left; background-color:#FFFFFF; margin-bottom:20px;">
                                            <tr>
                                                <td>
                                                    <h1 style="margin:0; font-family:Arial, sans-serif; color:#606060; letter-spacing:-1px; font-size:20px; font-weight:bold;">Dear {{ $customer }}</h1>
                                                    <p style="margin:0; font-family:Arial, sans-serif; color:#606060; line-height:150%; font-size:16px;">Please complete your payment as per detail below:</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <!--MAIN CALL TO ACTION BUTTON-->
                                        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#FFFFFF; border:1px solid #CCCCCC; margin-bottom:20px;">
                                            <tr>
                                                <td style="padding-top:10px; padding-right:10px; padding-bottom:10px; padding-left:10px;">
                                                    <img style="max-width: 200px" src="{{ url('image/profile/'.$room_photo) }}" class="captionImage" style="display:block; max-width:580px; margin-right: 0px;" />
                                                </td>
                       
                                                <td valign="top" style="width:100%;color:#505050; font-size:12px; font-style:italic; line-height:150%; padding-top:10px; padding-right;10px; padding-bottom:10px; padding-left:0px">
                                                    <h2 style="margin-bottom: 0;">{{ $room_name }}</h2>
                                                    <p style="margin-top: 0;">{{ $location_name }}</p>
                                                    <table>
                                                        <tr>
                                                            <td>Date</td>
                                                            <td>: {{ date('d F Y', strtotime($date_checkin)) }} - {{ date('d F Y', strtotime($date_checkout)) }}</td>
                                                        </tr>
                                                    </table>
                                                    <p style="margin-bottom: 5px;font-size:20px; font-weight: bold;">Rp. {{ number_format($grand_total, 0, ',', '.') }}</p>
                                                    <p style="margin-top: 0;">(included Service fee Kamartamu 10%)</p>
                                                </td>                           
                                            </tr>
                                        </table>
                                        <!--TEXT BOX-->
                                        <table border="0" cellpadding="0" cellspacing="0" width="600">
                                            <tr>
                                                <td>
                                                    <p style="text-align:left; color: #505050; background-color:#e8e8e8; border:1px solid #999999; margin-bottom:20px; font-size:12px; padding:20px; font-family:Arial, sans-serif; line-height:150%;">
                                                        Payment Method : {{ $bank }} <br/>
                                                        Account Number : {{ $va_numbers }} <br />
                                                        Account Name : PT. KAMARTAMU.COM <br />
                                                        <span style="font-style:italic;font-weight: bold;margin-top: 10px;display: block;">*this invoice will be expired in 1 day</span>
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                        <!--IMAGE WITH CAPTION ON LEFT-->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" valign="top" style="padding:0">
                            <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailFooter" style="background:#e8e8e8; border-top:10px solid #000000; margin-bottom:50px;">
                                <tr>
                                    <td align="center" valign="top">
                                        <!--FOOTER TEXT-->
                                        <table border="0" cellpadding="0" cellspacing="0" width="600" style="margin-bottom:20px;">
                                            <tr>
                                                <td align="left" valign="top" style="font-family:Arial, sans-serif; color:#606060; font-size:11px; line-height:150%;">
                                                    Copyright © {{ date('Y') }} kamartamu.com, All rights reserved.<br />
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
</body>
</html>
