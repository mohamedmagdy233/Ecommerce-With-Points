<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
</head>

<body>

<section id="invoice">
    <div class="container my-5 py-5">
        <div class="text-center">
            <img src="{{getFile(isset($setting) ? $setting->logo : asset('title.webp'))}}" alt="">
        </div>
        <div class="text-center border-top border-bottom my-5 py-3">
            <h2 class="display-5 fw-bold">فاتوره شراء </h2>
            <p class="m-0 fs-5">تاريخ الفاتوره: {{ date('Y-m-d') }}</p>
        </div>

        <div class="d-md-flex justify-content-between">
            <div>
                <p class="text-primary">معلومات العميل</p>
                <h4>{{ $order->customer->name }}</h4>
                <ul class="list-unstyled">
                    <li>الهاتف: {{ $order->customer->phone }}</li>
                    <li>البريد الإلكتروني: {{ $order->customer->email ?? 'لا يوجد' }}</li>
                    <li>العنوان: {{ $order->address ?? 'لا يوجد' }}</li>
                </ul>
            </div>
        </div>

        <table class="table border my-5">
            <thead>
            <tr class="bg-primary-subtle">
                <th scope="col">No.</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($order->products as $index => $product)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->total_price, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3"></td>
                <td class="text-primary fw-bold">Grand-Total</td>
                <td class="text-primary fw-bold">{{ number_format($order->total, 2) }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<!-- Button to generate PDF -->
<div class="text-center mb-5">
    <button class="btn btn-primary float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
        <i class="mdi mdi-printer ml-1"></i>طباعة
    </button>
</div>

<script type="text/javascript">
    function printDiv() {
        var printContents = document.getElementById('invoice').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

</body>
