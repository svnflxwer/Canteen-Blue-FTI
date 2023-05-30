@extends('layout.app')
@section('content')

<section class="section mt-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold">Sub Category Management</h5>
                        <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#addProduct">Add New Sub Category</button>
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
                                            Category</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Sub Category Name</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Slug</i>
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
                                @foreach($subcategories as $sc)
                                <tr>
                                    <td>
                                        <p class="text-sm">{{ $no }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $sc->category->category_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $sc->sub_category_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $sc->slug }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox form-switch p-0">
                                            <input class="form-check-input check_subcategory" type="checkbox"
                                                id="is_active" name="is_active" data-id="{{ $sc->id }}"
                                                @if($sc->is_active
                                            == 1) checked @endif>
                                        </div>
                                    </td>
                                    <td class=" text-end">
                                        <button type="button" class="btn secondary-btn rounded-full me-1"
                                            data-bs-toggle="modal" data-bs-target="#editSubCategory{{$sc->id}}">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                        <button type="button" class="btn danger-btn rounded-full del-sub_category"
                                            data-id="{{ $sc->id }}">
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

<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addProductLabel">Add New Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/sub_category" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category Name</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">Please select Category</option>
                            @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control" id="sub_category_name" name="sub_category_name"
                            placeholder="Category Name (eg. Roti)">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Slug (eg. minuman-bersoda)">
                    </div>
                    <div class="mb-3 border-top pt-3">
                        <button type="submit" class="btn btn-primary ms-auto d-block px-4">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@foreach($subcategories as $sc)
<div class="modal fade" id="editSubCategory{{$sc->id}}" tabindex="-1" aria-labelledby="editSubCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editSubCategoryLabel">Edit Sub Category</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/edit_subcategory" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="{{$sc->category_id}}">{{ $sc->category->category_name }}
                            </option>
                            @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Sub Category Name</label>
                        <input type="text" class="form-control" id="sub_category_name" name="sub_category_name"
                            placeholder="Sub Category Name (eg. Roti)" value="{{ $sc->sub_category_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Slug Name (eg. minuman-bersoda)" value="{{ $sc->slug }}">
                        <input type="hidden" name="sc_id" value="{{ $sc->id }}">
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