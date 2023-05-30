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

        <div class="row">

            <!-- End Col -->
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="titled-flex flex-wrap align-items-center justify-content-between border-bottom">
                        <div class="left d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-medium mb-30 fw-bold my-auto">Transaction History <span
                                    class="text-primary">{{ Auth::user()->name }}</span></h4>
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="table-responsive">
                        <table class="table top-selling-table">
                            <thead>
                                <tr>
                                    <th>
                                        <h6 class="text-sm text-medium fw-bold">
                                            Invoice ID
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium fw-bold">
                                            Products
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium fw-bold text-center">
                                            Payment Method </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium fw-bold text-center">
                                            Price </i>
                                        </h6>
                                    </th>

                                    <th class="min-width">
                                        <h6 class="text-sm text-medium fw-bold text-center">
                                            Status
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium text-end fw-bold text-center">
                                            Actions
                                        </h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payment_history as $ph)
                                <?php 
                                    $order_detail = OrderDetail::where('order_id',$ph->order_id)->get();
                                ?>
                                <tr>
                                    <td>
                                        <a class="text-sm status-btn secondary-btn"
                                            href="/invoice/{{ $ph->order->invoice_id }}">#{{ $ph->order->invoice_id }}</a>
                                    </td>
                                    <td>
                                        <ul class="list-group ">
                                            @foreach($order_detail as $od)
                                            <li class="list-group-item py-3">{{ $od->quantity }} x
                                                {{ $od->product->name }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <p class="text-sm text-center">{{ $ph->payment_method->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-center">Rp.
                                            {{ number_format($ph->total_harga,2,',','.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm text-center"><span
                                                class="status-btn {{ $ph->order->status_order->type }}-btn">{{ $ph->order->status_order->status_name }}</span>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <a class="status-btn close-btn" href="">Cancel</a>
                                    </td>
                                </tr>
                                @endforeach

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

@endsection