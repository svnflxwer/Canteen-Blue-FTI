@extends('layout.app')
@section('content')
<?php 
    use App\Models\OrderDetail;
?>
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
        <!-- ========== title-wrapper end ========== -->
        <div class="row">
            @foreach($order as $o)
            <div class="col-xl-4 col-lg-4 col-sm-6">
                <div class="card px-2 py-3 rounded shadow-sm">
                    <div class="card-body">
                        <h5 class="my-2">Invoice #{{ $o->invoice_id }} </h5>
                        <hr>
                        <div class="buyer d-flex justify-content-between">
                            <p class="card-title fw-bold">Buyer </p>
                            <p class="card-text">{{ $o->user->name }} </p>
                        </div>
                        <div class="date d-flex justify-content-between">
                            <p class="card-title fw-bold">Date </p>
                            <p class="card-text">{{ $o->created_at->format('d M y H:i') }} </p>
                        </div>
                        <hr>
                        <?php 
                            $order_detail = OrderDetail::where('order_id', $o->id)->get();
                        ?>
                        @foreach($order_detail as $od)
                        <div class="buyer d-flex justify-content-between align-items-start">
                            <p class="card-title"><span class="fw-bold">{{ $od->quantity }} x
                                    {{ $od->product->name }}</span> <br>
                                @if($od->description != null)
                                <small>NB: {{ $od->description }}</small>
                                @endif
                            </p>
                            <small class="card-text">Rp. {{ number_format($od->total_harga,2,',','.') }} </small>
                        </div>
                        @endforeach
                        <hr>
                        <div class="total d-flex justify-content-between mb-10">
                            <p class="card-title fw-bold">Price </p>
                            <p class="card-text">Rp. {{ number_format($o->total_harga,2,',','.') }}</p>
                        </div>
                        <div class="total row px-2">
                            <a href="" class="col btn primary-btn me-3 py-2 finishorder" data-id="{{ $o->id }}">Finish
                                Order</a>
                            <a href="" class=" col btn danger-btn py-2" data-id="{{ $o->id }}">Cancel</a>
                        </div>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            @endforeach
        </div>
    </div>
    <!-- end container -->
</section>
@endsection