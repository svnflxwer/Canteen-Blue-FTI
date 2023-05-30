@extends('layout.app')
@section('content')
<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30 pb-30">
            <div class="row align-items-center">
                <div class="col-md-6 ">
                    <div class="title mb-30 my-auto">
                        <h2>{{ $title }} Page</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 align-items-center">
                    <div class="breadcrumb-wrapper mb-30 my-auto">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb my-auto">
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

        <div class="row">

            <!-- End Col -->
            <div class="col-lg-5">
                <div class="card-style mb-30">
                    <div class="titled-flex flex-wrap align-items-center justify-content-between border-bottom">
                        <div class="left d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-medium mb-30 fw-bold my-auto">Payment Details <span class="text-primary">
                                    #{{ $order->invoice_id }}</span></h4>
                        </div>
                    </div>
                    <!-- End Title -->

                    <form action="/checkout" method="post">
                        @csrf
                        <div class="my-3">
                            <label for="method_header" class="form-label">Payment Method Type</label>
                            <select class="form-select" name="method_header" id="method_header">
                                <option value="">Select Payment Method Type</option>
                                @foreach($payment_header as $ph)
                                <option value="{{ $ph->id }}">{{ $ph->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="method" class="form-label">Payment Method</label>
                            <select class="form-select" name="method" id="method">
                                <option selected>Select Payment Method Type First</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="form-label">Holder Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                        </div>
                        <div class="mb-4">
                            <label for="numb" class="form-label">Holder Number</label>
                            <input type="text" class="form-control" id="numb" placeholder="0981776234" name="numb"
                                required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2  border-top">
                            <p>Subtotal Product</p>
                            <h5>Rp. {{ number_format($order->total_harga,2,',','.') }}</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pb-2">
                            <p>Discount</p>
                            <h5>Rp. 0</h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pb-3">
                            <p>Fee Transaksi</p>
                            <h5>Rp. <span id="fees">-</span></h5>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pb-3 pt-2  border-top">
                            <p>Total Price</p>
                            <h5>Rp. {{ number_format($order->total_harga,2,',','.') }}</h5>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100" type="submit">Checkout</button>
                        </div>
                    </form>


                </div>
            </div>
            <!-- End Col -->
            <!-- End Col -->
            <div class="col-lg-7">
                <div class="card-style mb-30">
                    <div class="titled-flex flex-wrap align-items-center justify-content-between border-bottom">
                        <div class="left d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-medium mb-30 fw-bold my-auto">Order Details <span class="text-primary">
                                    #{{ $order->invoice_id }}</span></h4>
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="table-responsive">
                        <table class="table top-selling-table">
                            <thead>
                                <tr>
                                    <th>
                                        <h6 class="text-sm text-medium fw-bold">
                                            Products
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium fw-bold">
                                            Quantity </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium fw-bold">
                                            Description </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium fw-bold text-end">
                                            Total Harga
                                        </h6>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_detail as $od)
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="image">
                                                <img src="https://www.spheretheme.com/html/steam/assets/images/dishes/05.jpg"
                                                    alt="" />
                                            </div>
                                            <p class="text-sm">{{ $od->product->name }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $od->quantity }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $od->description }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-end">Rp. {{ number_format($od->total_harga,2,',','.') }}
                                        </p>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3">
                                        <h6 class="text-sm text-medium fw-bold ">
                                            Total
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium fw-bold text-end">
                                            Rp. {{ number_format($order->total_harga,2,',','.') }}
                                        </h6>
                                    </th>

                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table -->
                    </div>
                </div>
                <div class="card-style mb-30">
                    <div class="titled-flex flex-wrap align-items-center justify-content-between border-bottom">
                        <div class="left d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-medium mb-30 fw-bold my-auto">Payment Tutorial</h4>
                        </div>
                    </div>
                    <!-- End Title -->
                    <ul class="list-group ">
                        <li class="list-group-item py-3">Pertama,Silahkan cek kembali orderan anda.</li>
                        <li class="list-group-item py-3">Selanjutnya, Pilih <b>Payment Method Type</b> terlebih dahulu
                        </li>
                        <li class="list-group-item py-3">Selanjutnya, Pilih <b>Payment Method</b> sesuai keinginan anda
                        </li>
                        <li class="list-group-item py-3">Lalu pada kolom input <b>Holder Name</b> silahkan masukkan Nama
                            pemegang kartu yang akan digunakan dalam pembayaran</li>
                        <li class="list-group-item py-3">Pada kolom <b>Holder Number</b> silahkan masukkan nomor
                            rekening /
                            no e-wallet yang digunakan untuk melakukan pembayaran</li>
                        <li class="list-group-item py-3">Selanjutnya klik <b>Checkout</b> dan anda akan diarahkan ke
                            menu
                            checkout</li>
                        <li class="list-group-item py-3">Silahkan lakukan pembayaran kedalam tujuan pengiriman yang
                            tertera, harap <b> nominal pembayaran</b> harus sama agar proses verifikasi pembayaran dapat
                            berjalan dengan lancar
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Col -->
        </div>

        <!-- End Row -->
    </div>
    <!-- end container -->
</section>

<!-- Modal -->
@foreach($order_detail as $o)
<div class="modal fade " id="editProduct{{$o->id}}" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-xxl-down p-5 ">
        <div class="modal-content p-2 ">
            <div class="modal-body">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>
                <div class="row g-0 h-100">
                    <div class="col-md-6 h-100 d-flex align-items-center">
                        <img src="https://www.spheretheme.com/html/steam/assets/images/dishes/04.jpg"
                            class="img-fluid rounded-start mx-auto w-75" alt="">
                    </div>
                    <div class="col-md-6 pt-5 pe-5">
                        <h2 class="fw-bold text-dark">{{ $o->product->name }}</h2>
                        <h5 class="fw-bold my-3 text-dark">Price : <span class="h4 text-primary">Rp.
                                {{ number_format($o->total_harga,2,',','.') }}</span>
                        </h5>
                        <p class="text-muted text-justify lh-md mb-3">{{ $o->description }}</p>
                        <form action="/editorder/{{$o->id}}" method="post">
                            @csrf
                            <h5 class="fw-bold mb-2 text-dark">Quantity</h5>
                            <div class="input-group w-25 mb-3 d-flex align-items-center">
                                <a type="button" class="quantity-left-minus{{$o->id}} h4 btn bg-transparent"
                                    data-type="minus" data-field="">
                                    <i class="fa fa-caret-left " aria-hidden="true"></i>
                                </a>
                                <input type="number" id="quantity{{$o->id}}" name="quantity"
                                    class="form-control input-number " min="1" max="100" value="{{ $o->quantity }}">

                                <a type="button" class="quantity-right-plus{{$o->id}} h4 btn bg-transparent"
                                    data-type="plus" data-field="">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </a>
                            </div>
                            <h5 class="fw-bold mb-2 text-dark">Additional Information</h5>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="keterangan"
                                    style="height: 100px" name="keterangan">{{$o->description}}</textarea>
                                <label for="keterangan">Please add mayonaise..</label>
                            </div>
                            <div class="d-flex">
                                <button type="reset" class="btn btn-secondary py-2 px-4 d-block ms-auto me-3">Reset
                                </button>
                                <button type="submit" class="btn btn-primary py-2 px-4 d-block ">Add to
                                    cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
$('#method_header').on('change', function(e) {
    console.log(e);
    var cat_id = e.target.value;
    $.get('/checkout/method?cat_id=' + cat_id, function(data) {
        $('#method').empty();
        $('#method').append('<option value="">Select Payment Method</option');
        $.each(data, function(index, methodObj) {
            $('#method').append('<option value="' + methodObj.id + '">' + methodObj
                .name + '</option');
        });
    });
});

$('#method').on('change', function(e) {
    console.log(e);
    var cat_id = e.target.value;
    $.get('/checkout/method_id?cat_id=' + cat_id, function(data) {
        $('#fees').empty();
        $.each(data, function(index, methodidObj) {
            $('#fees').append(methodidObj.fee);
        });
    });
});

$(document).ready(function() {
    $('.quantity-right-plus{{$o->id}}').click(function(e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity{{$o->id}}').val());

        // If is not undefined

        $('#quantity{{$o->id}}').val(quantity + 1);


        // Increment

    });

    $('.quantity-left-minus{{$o->id}}').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity{{$o->id}}').val());

        // If is not undefined

        // Increment
        if (quantity > 0) {
            $('#quantity{{$o->id}}').val(quantity - 1);
        }
    });

});
</script>
@endforeach
<!-- End Modal -->

@endsection