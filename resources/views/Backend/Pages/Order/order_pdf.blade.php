<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Order PDF</title>
    <style>
        body {
            font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            color: #333;
            box-sizing: border-box;
        }
        .container {
            /* padding: 20px; */
            /* border: 1px solid #ddd;
            width: 800px;
            margin: 0 auto; */
        }
        .clear::after {
            content: "";
            clear: both;
            display: block;
        }
        .header{
            border-bottom: 1px solid #333;
            margin-bottom: 20px;
        }
        .header .left{
            float: left;
        }
        .header .right{
            float: right;
        }
        .customerDetails .left{
            float: left;
        }
        .customerDetails .right{
            float: right;
        }
        .itemsTable, .summarytable {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .itemsTable th,
         .itemsTable td,
         .summarytable th,
         .summarytable td
         {
            padding: 15px;
            text-align: center;
        }
        .itemsTable th,
        .summarytable th
         {
            border-top: 2px solid #ddd;
            border-bottom: 2px solid #ddd;
        }
        .itemsTable td,
        .summarytable td
        {
            border-bottom: 1px solid #ddd;
        }
        a{
            text-decoration: none;
            color: black;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        .summarytable th{
            border-top: none;
            border-bottom: 1px solid #ddd;
            text-align: right;
        }
        .summarytable td{
            padding-right: 30px;
            text-align: right;
        }
        .summarytable .total-amount{
            border-bottom: none ;
        }
    </style>
</head>
<body>
    <div class="header clear">
        <div class="left">
            <h1 style="margin-bottom: 10px">ProMaxBPO</h1>
            {{-- <img src="{{ asset('front/assets/images/primary_logo2.png') }}" alt=""> --}}
            <div><b>Email:</b> info@promaxbpo.com</div>
            <div style="margin-bottom: 20px"><b>Phone:</b> 01643381009</div>
        </div>
        <div class="right">
            <h3 style="text-transform: uppercase">INVOICE</h3>
        </div>
    </div>
    <div class="customerDetails clear">
        <div class="left">
            <table>
                <tr>
                    <td><b>Bill To</b></td>
                </tr>
                <tr>
                    <td>{{ $order->user ? $order->user->name : '' }}</td>
                </tr>
                <tr>
                    <td>{{ $order->user ? $order->user->email : '' }}</td>
                </tr>
                <tr>
                    <td>{{ $order->user ? $order->user->mobile : '' }}</td>
                </tr>
                <tr>
                    <td>{{ $order->user ? $order->user->address : '' }}</td>
                </tr>
                <tr>
                    <td>{{ $order->user ? $order->user->country : 'Bangladesh' }}</td>
                </tr>
            </table>
        </div>
        <div class="right">
            <table>
                <tr>
                    <td>Order ID</td>
                    <td style="padding-left:25px">{{ $order->order_id }}</td>
                </tr>
                <tr>
                    <td>Order date </td>
                    <td style="padding-left:25px">{{ $order->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Order status </td>
                    <td style="padding-left:25px"><span class="badge badge-primary ml-3">{{ $order->delivery_status }}</span></td>
                </tr>
                <tr>
                    <td>Payment method </td>
                    <td style="padding-left:25px">{{ $order->payment_method }}</td>
                </tr>
            </table>
        </div>
    </div>

    <br>

    <table class="itemsTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Bookkeeping: QuickBooks Online & Xero</td>
                <td>{{$order->total }}</td>
                <td>1</td>
                <td>{{$order->total }}</td>
            </tr>
        </tbody>
    </table>

    <div class="row justify-content-end">
        <div class="col-md-4 col-of">
            <table class="summarytable">
                <tr>
                    <td>Sub Total :</td>
                    <td>{{ number_format($order->sub_total) }} Taka</td>
                </tr>
                <tr>
                    <td>Total :</td>
                    <td style="font-weight: 900">{{ number_format($order->total) }} Taka</td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
