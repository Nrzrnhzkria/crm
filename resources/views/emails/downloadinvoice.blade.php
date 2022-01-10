<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
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
        column-span: 8;
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
        text-align: right;
        
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
                <td colspan="8">
                    <table>
                        <tr>
                            <td class="title">
                                <a href="https://ibb.co/ncWZLTQ"><img src="https://i.ibb.co/xj4P7yz/Group-1.png" alt="Group-1" border="0" width="30%"/></a>
                            </td>
                            
                            <td></td>
 
                            <td>
                                <strong>Momentum Internet</strong><strong> Sdn Bhd</strong>
                                <strong>1079998-A</strong><br>
                                288 Tingkat 1, Jalan Lambak,<br>
                                86000 Kluang, Johor.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="8">
                    <table>
                        <tr>
                            <td>To<br>
                                <strong>{{ $name }} {{ $secondname }}</strong><br>
                            </td>

                            <td></td>

                            <td>
                                <strong>Invoice :</strong> {{ $inv->invoice_id }}<br>
                                <strong>Invoice Date :</strong> {{ $inv->for_date }}<br>
                                <strong>Due Date :</strong> {{ $datesum }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                    <td>
                        No
                    </td>
                    
                    <td>
                        Item & Description
                    </td>
                    
                    <td>
                        Qty
                    </td>

                    <td></td>

                    <td style="text-align: right">
                        Rate
                    </td>

                    <td colspan="8" style="text-align: right">
                        Amount
                    </td>
            </tr>
            <tr class="item">
                <td>
                    1
                </td>
                <td>
                    MBM - {{ $membership }}<br>
                    <em>Monthly Consultation Fees - {{ $inv->for_date }}</em>
                </td>
                
                <td>
                    1
                </td>

                <td></td>
                
                <td style="text-align: right">
                    {{ $inv->price }}
                </td>

                <td colspan="8" style="text-align: right">
                    {{ $inv->price }}
                </td>
            </tr>
            @if ($membership == 'Ultimate Plus' || $membership == 'Ultimate Partners')
            <tr class="item">
                <td>
                    2
                </td>
                <td>
                    {{ $member->add_on_name }}<br>
                    <em>Consultation Fee with Dato' Norhafis Suleiman {{ $inv->for_date }}</em>
                </td>
                
                <td>
                    1
                </td>

                <td></td>

                <td style="text-align: right">
                    {{ $member->add_on_price }}
                </td>

                <td colspan="8" style="text-align: right">
                    {{ $member->add_on_price }}
                </td>
            </tr>
            @else  
            @endif
            
            <tr class="information">
            <td colspan="8">
                <table>
                    <tr>
                        <td>
                            <br>
                            <br>
                        </td>

                        <td></td>
                        @if ($membership == 'Ultimate Plus' || $membership == 'Ultimate Partners')
                        <td>
                            Sub Total RM{{ $subtotal }}<br>
                            Total Taxable Amount RM 9433.96<br>
                            SST ({{ $member->tax }}%) RM 566.04<br>
                            <hr style="width:35%;text-align:right;margin-right:0">
                            <strong>Total RM{{ $subtotal }}</strong><br>
                            <hr style="width:35%;text-align:right;margin-right:0">
                            <strong>Balance Due RM{{ $subtotal }}</strong><br>
                        </td>
                        @else
                        <td>
                            Sub Total RM{{ $inv->price }}<br>
                            <strong>Total RM{{ $inv->price }}<br></strong>
                            <strong>Balance Due RM{{ $balance }}<br></strong>
                        </td>
                        @endif
                    </tr>
                </table>
            </td>
            </tr>
        </table>
        <br>
        <footer class="left mt-1" style="font-size: 9pt;">
            Terms & Conditions<br>
            1) All payment must be made to Maybank Account No. : 5510 6130 6335 in favour of Momentum Internet Sdn Bhd.<br>
            2) This is computer generated document, no signature is required.<br>
            3) After made payment, kindly notify via WhatsApp your payment receipt to person in charge:-<br>
             ** Puan Zura - 010-7720341 / Cik Suhada - 011-15048010
        </footer>
    </div>
</body>
</html>


