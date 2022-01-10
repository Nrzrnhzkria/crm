<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Customer Statement Account</title>
    
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
                                <h3><strong>Statement of Accounts</strong></h3>
                                 1/1/2021 to 31/12/2021<br><br>
                                <strong>Account Summary</strong><br><br>
                                <strong>Invoiced Amount</strong> {{ $invoice_amount }}<br>
                                <strong>Amount Received</strong> {{ $amount_received }}<br>
                                <strong>Balance Due</strong> {{ $balance_due }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                    <td>
                        Date
                    </td>
                    
                    <td>
                        Transactions
                    </td>
                    
                    <td>
                        Details
                    </td>

                    <td>
                        Amount
                    </td>
                    
                    <td>
                        Payments
                    </td>
                    
                    <td colspan="8">
                        Balance
                    </td>
            </tr>
            @foreach ($invoice as $invoices)
                @if ($invoices->status == 'paid')
                    {{-- INVOICE --}}
                    <tr class="item">
                        <td>
                            {{ $invoices->for_date }}
                        </td>

                        <td>
                            Invoice
                        </td>

                        <!-- table membership-->
                        <td>
                            <strong>{{ $invoices->invoice_id }}</strong><br>
                            <em>due on {{ $invoices->for_date }}</em>
                        </td>

                        <!-- table payment-->
                        <td>
                            {{ $invoices->price }}
                        </td>
                        
                        <!-- table payment-->
                        <td>
                            
                        </td>
                        
                        @if ($invoices->price)
                            <td colspan="8">
                                {{ $invoices->price }}
                            </td>
                        @else
                            <td colspan="8">
                                {{ $price }}
                            </td>   
                        @endif
                    </tr>

                    {{-- PAYMENT --}}
                    <tr class="item">
                        <td>
                            {{ $invoices->for_date }}
                        </td>

                        <td>
                            Payment
                        </td>

                        <!-- table membership-->
                        <td>
                            <strong>{{ $invoices->invoice_id }}</strong><br>
                            <em><strong>RM{{ $invoices->price }}</strong> for payment of {{ $invoices->invoice_id }}</em>
                        </td>

                        <!-- table payment-->
                        <td>
                            
                        </td>
                        
                        <!-- table payment-->
                        <td>
                            {{ $invoices->price }}
                        </td>
                        
                        @if ($balance == 0)
                            <td colspan="8">
                                0
                            </td>
                        @else
                            <td colspan="8">
                                {{ $invoices->price }}
                            </td>   
                        @endif
                    </tr>
                @else 
                <tr class="item">
                    <td>
                        {{ $invoices->for_date }}
                    </td>

                    <td>
                        Invoice
                    </td>

                    <!-- table membership-->
                    <td>
                        <strong>{{ $invoices->invoice_id }}</strong><br>
                        <em>due on {{ $invoices->for_date }}</em>
                    </td>

                    <!-- table payment-->
                    <td>
                        {{ $invoices->price }}
                    </td>
                    
                    <!-- table payment-->
                    <td>
                        
                    </td>
            
                    @if ($invoices->price != 0)
                        <td colspan="8">
                            {{-- {{ $invoices->price }} --}}
                            {{ ($total += $invoices->price)-($price) }}
                        </td>
                    @else
                        <td colspan="8">
                            {{ $price }}
                        </td>   
                    @endif
                @endif
            @endforeach
            
            <tr class="information">
            <td colspan="8">
                <table>
                    <tr>
                        <td>
                            <br>
                            <br>
                        </td>

                        <td></td>
                       <td>
                            <strong>Balance Due </strong> RM {{ $balance_due }}<br>
                        </td>
                    </tr>
                </table>
            </td>
            </tr>
        </table>
        <footer class="left mt-1" style="font-size: 9pt;">
        </footer>
    </div>
</body>
</html>


