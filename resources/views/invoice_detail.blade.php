@extends('layout.app')
@section('content')
<section>
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title d-flex align-items-center flex-wrap mb-30">
                        <h2 class="mr-40">{{ $title }} Page</h2>

                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#0">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $title }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- Invoice Wrapper Start -->
        <div class="invoice-wrapper" id="invoice-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="invoice-card card-style mb-30 p-5">
                        <div class="invoice-header d-flex flex-wrap align-items-center justify-content-between">
                            <div class="invoice-for">
                                <h2 class="mb-10">Invoice <span class="text-primary fw-bold">
                                        #{{$order->invoice_id}}</span></h2>
                                <p class="fw-bold h4">
                                    Status : {{ $order->status_order->status_name }}
                                </p>
                            </div>
                            <div class="invoice-logo">
                                <img src="{{url('')}}/assets/images/invoice/uideck-logo.svg" alt="" />
                            </div>
                            <div class="invoice-date">
                                <p><span>Date Issued:</span> 20/02/2024</p>
                                <p><span>Date Due:</span> 20/02/2028</p>
                            </div>
                        </div>
                        <div class="invoice-address d-flex flex-wrap align-items-center ">
                            <div class="address-item">
                                <h5 class="text-bold">Invoiced To</h5>
                                <h1>{{ $order->user->name }}</h1>
                                <p class="text-sm">
                                    <span class="text-medium">Handphone:</span>
                                    {{ $order->user->no_hp }}
                                </p>
                                <p class="text-sm">
                                    <span class="text-medium">Email:</span>
                                    {{ $order->user->email }}
                                </p>
                            </div>
                            <div class="address-item">
                                <h5 class="text-bold">Pay To</h5>
                                <h1>Blue Canteen</h1>
                                <p class="text-sm">
                                    Universitas Kristen Satya Wacana
                                </p>
                                <p class="text-sm">
                                    <span class="text-medium">Email:</span>
                                    admin@bluecanteen.com
                                </p>
                            </div>
                        </div>
                        <h4 class="fw-bold mb-10">Invoice Payment</h4>
                        <div class="table-responsive mb-30">
                            <table class="invoice-table table">
                                <thead>
                                    <tr>
                                        <th class="service ">
                                            <h6 class="text-sm text-medium">Method</h6>
                                        </th>
                                        <th class="desc ">
                                            <h6 class="text-sm text-medium">Payment From</h6>
                                        </th>
                                        <th class="qty ">
                                            <h6 class="text-sm text-medium">Payment to</h6>
                                        </th>
                                        <th class="amount text-end">
                                            <h6 class="text-sm text-medium">Price</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p class="text-sm">{{ $payment->payment_method->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm ">
                                                <strong>{{ $payment->holder_number }}</strong><br>
                                                {{ $payment->holder_name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm ">
                                                <strong>{{ $payment->payment_method->holder_number }}</strong><br>
                                                {{ $payment->payment_method->holder_name }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm text-end">Rp.
                                                {{ number_format($payment->total_harga,2,',','.') }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h4 class="fw-bold mb-10">Invoice Items</h4>
                        <div class="table-responsive">
                            <table class="invoice-table table">
                                <thead>
                                    <tr>
                                        <th class="service fw_bo">
                                            <h6 class="text-sm text-medium ">Products</h6>
                                        </th>
                                        <th class="desc text-center">
                                            <h6 class="text-sm text-medium">Quantity</h6>
                                        </th>
                                        <th class="qty text-center">
                                            <h6 class="text-sm text-medium">Description</h6>
                                        </th>
                                        <th class="amount text-end">
                                            <h6 class="text-sm text-medium">Price</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_detail as $od)
                                    <tr>
                                        <td>
                                            <p class="text-sm">{{ $od->product->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm text-center">
                                                {{ $od->quantity }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-sm text-center">{{ $od->description }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm text-end">Rp.
                                                {{ number_format($od->total_harga,2,',','.') }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">
                                            <p class="text-sm fw-bold">Subtotal Product</p>
                                        </td>

                                        <td>
                                            <p class="text-sm text-end fw-bold">Rp.
                                                {{ number_format($od->total_harga,2,',','.') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p class="text-sm fw-bold">Transaction Fee</p>
                                        </td>

                                        <td>
                                            <p class="text-sm text-end fw-bold">Rp.
                                                {{ number_format($payment_method->fee,2,',','.') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p class="text-sm fw-bold">Total Price</p>
                                        </td>

                                        <td>
                                            <p class="text-sm text-end fw-bold">Rp.
                                                {{ number_format($payment->total_harga,2,',','.') }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="note-wrapper warning-alert py-4 px-sm-3 px-lg-5">
                            <div class="alert">
                                <h5 class="text-bold mb-15">Notes:</h5>
                                <p class="text-sm text-gray">
                                    Harap transfer sesuai dengan nominal yang tertera. Pastikan data yang anda masukkan
                                    benar. Jika ada pertanyaan bisa langsung hubungi Admin
                                </p>
                            </div>
                        </div>
                        <div class="invoice-action">
                            <ul class="d-flex flex-wrap align-items-center justify-content-center">
                                <li class="m-2">
                                    <button role="button" class="main-btn primary-btn-outline btn-hover"
                                        onclick="javascript:printDiv('invoice-wrapper');">
                                        Download Invoice
                                    </button>
                                </li>
                                <li class="m-2">
                                    <a href="#0" class="main-btn primary-btn btn-hover">
                                        Send Invoice
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
                <!-- ENd Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- Invoice Wrapper End -->
    </div>
    <!-- end container -->
</section>

@endsection

<script type="text/javascript">
function printDiv(elementId) {
    var divContents = document.getElementById(elementId).innerHTML;
    var bodyy = document.body.innerHTML;
    var a = window.open('', '', 'height=900, width=900');
    a.document.write('<html>');
    a.document.write('<head>');
    a.document.write('<link rel="stylesheet" href="{{url("")}}/assets/css/bootstrap.min.css" />');
    a.document.write('<link rel="stylesheet" href="{{url("")}}/assets/css/main.css" />');
    a.document.write('<head>');
    a.document.write('</head>');
    a.document.write('<body>');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.onafterprint = window.close;
    a.print();

}
</script>