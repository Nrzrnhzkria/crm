<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-GB">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>E-Cert | Momentum Internet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style>
        * {
            margin: 0;
            padding: 0;
        }
        .bg {
            /* The image used */
            background-image: url("{{ $cert_image }}");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
    </style>
</head>
<body class="bg">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" colspan="2" style="padding: 20px 0 80px 0;">
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" style="padding: 40px 0 25px 0;">
                <img src="{{ asset('assets/images/logo_text.png') }}" style="margin: 0; max-width:150px">
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" style="padding: 40px 0 25px 0;">
                <h1 style="margin: 0;">CERTIFICATE</h1>
                <h1 style="margin: 0;">OF COMPLETION</h1>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" style="padding: 40px 0 25px 0;">
                <p style="margin: 0;">This certifies that</p>
                <h3 style="margin: 0;"> {{ ucwords(strtolower($first_name)) }} {{ ucwords(strtolower($last_name)) }}</h3>
                <h4 style="margin: 0;"> ({{ $ic }})</h4>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" style="padding: 40px 0 25px 0;">
                <p style="margin: 0;"> has successfully completed the course</p>
                <h3 style="margin: 0;"> {{ $program_name }}</h3>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" style="padding: 40px 0 25px 0;">
                <p style="margin: 0;"> that was held on </p>
                <h3 style="margin: 0;"> {{ $date_from }} &nbsp; - &nbsp; {{ $date_to }}</h3>
            </td>
        </tr>
        <tr>
            <td align="center" style="padding: 80px 0 50px 0;">
                <img src="{{ asset('assets/images/cert_badge.png') }}" style="max-width:150px; margin: 0;">
            </td>
            <td align="center" style="padding: 80px 0 50px 0;">
                <img src="{{ asset('assets/images/sign.png') }}" style="max-width:80px; margin: 0;">
                <h3 style="margin: 0;">Najib Asaddok</h3>
                <p style="margin: 0;"> Chief Executive Officer (CEO)</p>
                <p style="margin: 0;"> Momentum Internet Sdn Bhd </p>
            </td>
        </tr>
    </table>
    
</body>
</html>