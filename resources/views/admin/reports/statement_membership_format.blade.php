<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer Invoice</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(3) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(3) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .invoice-box .notices {
    padding-left: 6px;
    border-left: 6px solid #303030
    }

    .center {
      margin: auto;
      width: 70%;
      padding: 10px;
      text-align: center;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(3) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="data:image/png;base64,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" style="width:100%; max-width:100px;">
                            </td>
                            
                            <td></td>
 
                            <td>
                                Momentum Internet Sdn Bhd<br>
                                288 Tingkat 1, Jalan Lambak,<br>
                                86000 Kluang, Johor.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            

        </table>
        {{-- <br>
        <div class="notices">
            <div>Notes:</div>
            <div class="notice">To update the participant information, please click on the 'Kemaskini' button that appears in the email.</div>
        </div> --}}
        <br>
        <footer class="center" style="font-size: 10pt;">
            This is a computer generated invoice. No signature is required.
        </footer>
    </div>
</body>
</html>


