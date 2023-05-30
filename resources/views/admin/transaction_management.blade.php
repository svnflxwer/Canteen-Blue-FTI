@extends('layout.app')
@section('content')
<?php 
    use App\Models\OrderDetail;
?>
<section class="section">
    <div class="container-fluid ">
        <!-- ========== title-wrapper start ========== -->
        <div class="row">
            <!-- End Col -->
            <div class="col-lg-12">
                <div class="card-style mb-30 mt-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold">Transaction History</h5>
                        <button href="" class="btn btn-primary px-4 py-2 ">Print Report</button>
                    </div>
                    <hr>
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
                                        <h6 class="text-sm text-medium text-center">
                                            Status </i>
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium text-center">
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
                                        <a class="text-sm status-btn secondary-btn"
                                            href="/invoice/{{ $p->order->invoice_id }}">
                                            <p class="text-sm">#{{ $p->order->invoice_id }}</p>
                                        </a>
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
                                        <p class="text-sm">Rp.{{ number_format($p->total_harga,2,',','.') }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->payment_method->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm"> <strong>{{ $p->holder_number }} </strong> <br>
                                            {{ $p->holder_name }} </p>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="btn status-btn {{ $p->order->status_order->type }}-btn">{{ $p->order->status_order->status_name }}</span>
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col">
                                                @if($p->order->status_order_id == 3)
                                                <button class="btn primary-btn btn-hover confirm-order"
                                                    data-id="{{ $p->order->id }}">Confirmation</button>
                                                @elseif($p->order->status_order_id == 4)
                                                <button class="btn success-btn btn-hover finish-order"
                                                    data-id="{{ $p->order->id }}">Finish</button>
                                                @endif
                                                @if($p->order->status_order_id != 6)
                                                <button class=" btn danger-btn rounded-circle cancel-order"
                                                    data-id="{{ $p->order->id }}"><i class="fa fa-close"></i></button>
                                                @endif
                                            </div>
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