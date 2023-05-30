@extends('layout.app')
@section('content')

<section class="section mt-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card-style mb-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold">Category Management</h5>
                        <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#addCategory">Add New Category</button>
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
                                            Category Name</i>
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
                                @foreach($categories as $c)
                                <tr>
                                    <td>
                                        <p class="text-sm">{{ $no }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $c->category_name }}</p>
                                    </td>
                                    <td class="text-center">

                                        <div class="custom-control custom-checkbox form-switch p-0">
                                            <input class="form-check-input check_category" type="checkbox"
                                                id="is_active" name="is_active" data-id="{{ $c->id }}" @if($c->is_active
                                            == 1) checked @endif>
                                        </div>
                                    </td>
                                    <td class=" text-end">
                                        <button type="button" class="btn secondary-btn rounded-full me-1"
                                            data-bs-toggle="modal" data-bs-target="#editCategory{{$c->id}}">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                        <button type="button" class="btn danger-btn rounded-full del-cat"
                                            data-id="{{ $c->id }}">
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

<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addCategoryLabel">Add New Payment</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/category" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Payment Method Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            placeholder="Category Name (eg. Makanan)">
                    </div>
                    <div class=" mb-3 border-top pt-3">
                        <button type="submit" class="btn btn-primary ms-auto d-block px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($categories as $c)
<div class="modal fade" id="editCategory{{$c->id}}" tabindex="-1" aria-labelledby="editCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editCategoryLabel">Edit Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/edit_category" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="cat_id" value="{{ $c->id }}">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            placeholder="Category Name (eg. Minuman)" value="{{ $c->category_name }}">
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