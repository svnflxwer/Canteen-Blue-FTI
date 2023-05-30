@extends('layout.app')
@section('content')

<section class="section mt-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold">Payment Method</h5>
                        <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#addPayment">Add New Payment</button>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table">
                            <thead>
                                <tr>
                                    <th class="">
                                        <h6 class="text-sm text-medium">
                                            No </i>
                                        </h6>
                                    </th>
                                    <th class="min-width text-start">
                                        <h6 class="text-sm text-medium">
                                            Payment Header</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Payment Name </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Payment Holder </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Payment Fee </i>
                                        </h6>
                                    </th>
                                    <th class="min-width text-center">
                                        <h6 class="text-sm text-medium">
                                            Is Active? </i>
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
                                <?php 
                                    $no = 1;
                                ?>
                                @foreach($payment as $p)
                                <tr>
                                    <td>
                                        <p class="text-sm">{{ $no }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $p->payment_method_header->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm"><span class="fw-bold">{{ $p->holder_name }}</span> <br>
                                            {{ $p->holder_number }} </p>
                                    </td>
                                    <td>
                                        <p class="text-sm">Rp. {{ number_format($p->fee,2,',','.') }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox form-switch p-0">
                                            <input class="form-check-input check_payment" type="checkbox" id="is_active"
                                                name="is_active" data-id="{{ $p->id }}" @if($p->is_active
                                            == 1) checked @endif>
                                        </div>
                                    </td>
                                    <td class=" text-end">
                                        <button type="button" class="btn secondary-btn rounded-full me-1"
                                            data-bs-toggle="modal" data-bs-target="#editPayment{{$p->id}}">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                        <button type="button" class="btn danger-btn rounded-full">
                                            <i class="lni lni-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php 
                                    $no++;
                                ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="addPayment" tabindex="-1" aria-labelledby="addPaymentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addPaymentLabel">Add New Payment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/payment" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="payment_header" class="form-label">Payment Method Header</label>
                        <select class="form-select" id="payment_header" name="payment_header">
                            <option value="">Please select payment header</option>
                            @foreach($payment_header as $ph)
                            <option value="{{ $ph->id }}">{{ $ph->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Method Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Payment Name (eg. OVO)">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Holder</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Payment Holder Name"
                                    name="holder_name" id="holder_name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Payment Holder Number"
                                    name="holder_number" id="holder_number">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Fee</label>
                        <div class="input-group ">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" name="fee" id="fee" value="0">
                        </div>
                    </div>
                    <div class="mb-3 border-top pt-3">
                        <button type="submit" class="btn btn-primary ms-auto d-block px-4">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@foreach($payment as $p)
<div class="modal fade" id="editPayment{{$p->id}}" tabindex="-1" aria-labelledby="editPaymentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editPaymentLabel">Edit New Payment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/edit_payment" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="payment_header" class="form-label">Payment Method Header</label>
                        <select class="form-select" id="payment_header" name="payment_header">
                            <option value="{{$p->payment_method_header_id}}">{{ $p->payment_method_header->name }}
                            </option>
                            @foreach($payment_header as $ph)
                            <option value="{{ $ph->id }}">{{ $ph->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Method Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Payment Name (eg. OVO)" value="{{ $p->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Holder</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Payment Holder Name"
                                    name="holder_name" id="holder_name" value="{{ $p->holder_name }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Payment Holder Number"
                                    name="holder_number" id="holder_number" value="{{ $p->holder_number }}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Fee</label>
                        <div class="input-group ">
                            <span class="input-group-text">Rp.</span>
                            <input type="hidden" name="pay_id" value="{{ $p->id }}">

                            <input type="number" class="form-control" name="fee" id="fee" value="{{ $p->fee }}">
                        </div>
                    </div>
                    <div class="mb-3 border-top pt-3">
                        <button type="submit" class="btn btn-primary ms-auto d-block px-4">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach
@endsection