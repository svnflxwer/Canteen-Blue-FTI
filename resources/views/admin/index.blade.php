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
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <i class="lni lni-cart-full"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">New Orders</h6>
                        <h3 class="text-bold mb-10">34567</h3>
                        <p class="text-sm text-success">
                            <i class="lni lni-arrow-up"></i> +2.00%
                            <span class="text-gray">(30 days)</span>
                        </p>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon success">
                        <i class="lni lni-dollar"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Income</h6>
                        <h3 class="text-bold mb-10">$74,567</h3>
                        <p class="text-sm text-success">
                            <i class="lni lni-arrow-up"></i> +5.45%
                            <span class="text-gray">Increased</span>
                        </p>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon primary">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Expense</h6>
                        <h3 class="text-bold mb-10">$24,567</h3>
                        <p class="text-sm text-danger">
                            <i class="lni lni-arrow-down"></i> -2.00%
                            <span class="text-gray">Expense</span>
                        </p>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon orange">
                        <i class="lni lni-user"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">New User</h6>
                        <h3 class="text-bold mb-10">34567</h3>
                        <p class="text-sm text-danger">
                            <i class="lni lni-arrow-down"></i> -25.00%
                            <span class="text-gray"> Earning</span>
                        </p>
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
        <div class="row">

            <!-- End Col -->
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="titled-flex flex-wrap align-items-center justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-30">Sales History</h6>
                        </div>
                        <hr>
                    </div>
                    <!-- End Title -->
                    <div class="table-responsive">
                        <table class="table top-selling-table">
                            <thead>
                                <tr>

                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Invoice ID </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Buyer</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Product List </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Total Price </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Payment Method </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Holder </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Status </i>
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium text-end">
                                            Actions </i>
                                        </h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payment as $p)
                                <?php 
                                    $order_detail = OrderDetail::where('order_id',$p->order->id)->get();
                                ?>
                                <tr>
                                    <td>
                                        <p class="text-sm">{{ $p->order->invoice_id }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->user->name }}</p>
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
                                        <p class="text-sm">{{ $p->total_harga }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->payment_method->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm"> <strong>{{ $p->holder_number }} </strong> <br>
                                            {{ $p->holder_name }} </p>
                                    </td>
                                    <td>
                                        <span
                                            class="btn status-btn {{ $p->order->status_order->type }}-btn">{{ $p->order->status_order->status_name }}</span>
                                    </td>
                                    <td>
                                        <div class="action justify-content-end">
                                            <button class="edit">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="lni lni-more-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Remove</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
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