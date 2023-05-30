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
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="titled-flex flex-wrap align-items-center justify-content-between border-bottom">
                        <div class="left d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-medium mb-30 fw-bold my-auto">Cart <span class="text-primary">
                                    #{{ $order->invoice_id }}</span></h4>
                            <a class="btn btn-primary " href="/product"><i class="lni lni-plus"></i> Add new
                                products</a>
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
                                        <h6 class="text-sm text-medium fw-bold">
                                            Total Harga
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium text-end fw-bold">
                                            Actions
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
                                        <p class="text-sm">Rp. {{ number_format($od->total_harga,2,',','.') }}</p>
                                    </td>
                                    <td>
                                        <div class="action justify-content-end">
                                            <button class="edit" role="button" data-bs-toggle="modal"
                                                data-bs-target="#editProduct{{$od->id}}">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <a class="btn bg-transparent" href="/delcart/{{$od->id}}"><i
                                                    class="lni lni-trash-can"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th colspan="3">
                                        <h6 class="text-sm text-medium fw-bold">
                                            Total
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium fw-bold">
                                            Rp. {{ number_format($order->total_harga,2,',','.') }}
                                        </h6>
                                    </th>
                                    <th class="text-end">
                                        <button class="btn btn-outline-primary px-2">Checkout</button>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table -->
                    </div>
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