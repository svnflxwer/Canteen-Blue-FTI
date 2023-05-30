@extends('layout.app')
@section('content')

<section class="section mt-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold">Product Management</h5>
                        <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal"
                            data-bs-target="#addProduct">Add New Product</button>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table top-selling-table table-hover">
                            <thead>
                                <tr>
                                    <th class="">
                                        <h6 class="text-sm text-medium">
                                            No </i>
                                        </h6>
                                    </th>
                                    <th class="">
                                        <h6 class="text-sm text-medium">
                                            SubCategory</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Product Name</i>
                                        </h6>
                                    </th>
                                    <th class="">
                                        <h6 class="text-sm text-medium">
                                            Product Description</i>
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm ">
                                            Slug</i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Price</i>
                                        </h6>
                                    </th>
                                    <th class="text-center">
                                        <h6 class="text-sm text-medium">
                                            Stock</i>
                                        </h6>
                                    </th>
                                    <th class="">
                                        <h6 class="text-sm ">
                                            Photo URL</i>
                                        </h6>
                                    </th>
                                    <th class="min-width text-center">
                                        <h6 class="text-sm text-medium">
                                            Is Active? </i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
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
                                @foreach($products as $p)
                                <tr>
                                    <td>
                                        <p class="text-sm">{{ $no }}</p>
                                    </td>
                                    <td class="text-start">
                                        <p class="text-sm">{{ $p->sub_category->sub_category_name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->description }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->slug }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ number_format($p->price,2,',','.') }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm">{{ $p->stock }}</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">{{ $p->photo }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-checkbox form-switch p-0">
                                            <input class="form-check-input check_product" type="checkbox" id="is_active"
                                                name="is_active" data-id="{{ $p->id }}" @if($p->is_active
                                            == 1) checked @endif>
                                        </div>
                                    </td>
                                    <td class=" text-end" nowrap>
                                        <button type="button" class="btn secondary-btn rounded-full me-1"
                                            data-bs-toggle="modal" data-bs-target="#editProduct{{$p->id}}">
                                            <i class="lni lni-pencil"></i>
                                        </button>
                                        <button type="button" class="btn danger-btn rounded-full del-product"
                                            data-id="{{ $p->id }}">
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
                <form action="/admin/product" method="post" enctype="multipart/form-data">
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
                        <label for="category_id" class="form-label">Sub Category Name</label>
                        <select class="form-select" id="sub_category_id" name="sub_category_id">
                            <option value="">Please select Sub Category</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Product Name (eg. Roti Cokelat)">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Slug (eg. minuman-bersoda)">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="price" class="form-label">Product Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" placeholder="12000" id="price" name="price">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="name" class="form-label">Product Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock"
                                placeholder="Stock (eg. 100)">
                        </div>
                    </div>
                    <div class="form-group mb-25">
                        <div class="row align-items-end">
                            <div class="col-sm-3">
                                <img src="" class="img-thumbnail" id="output">
                            </div>
                            <div class="col-sm-9 ">
                                <div class="custom-file mt-auto">
                                    <input type="file" class="form-control cs" id="image" name="image">
                                </div>
                            </div>
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

@foreach($products as $p)
<div class="modal fade" id="editProduct{{$p->id}}" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editProductLabel">Edit Products</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <form action="/admin/edit_product" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category Name</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="{{ $p->sub_category->category->id }}">
                                {{ $p->sub_category->category->category_name }}</option>
                            @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Sub Category Name</label>
                        <select class="form-select" id="sub_category_id" name="sub_category_id">
                            <option value="{{ $p->sub_category_id }}">{{ $p->sub_category->sub_category_name }}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Product Name (eg. Roti Cokelat)" value="{{ $p->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea class="form-control" id="description" name="description"
                            rows="3">{{ $p->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Slug (eg. minuman-bersoda)" value="{{ $p->slug }}">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label for="price" class="form-label">Product Price</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" placeholder="12000" id="price" name="price"
                                    value="{{ $p->price }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="name" class="form-label">Product Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock"
                                placeholder="Stock (eg. 100)" value="{{ $p->stock }}">
                        </div>
                    </div>
                    <div class="form-group mb-25">
                        <div class="row align-items-end">
                            <div class="col-sm-3">
                                <img src="{{url('storage')}}/{{ $p->photo }}" class="img-thumbnail" id="output">
                            </div>
                            <div class="col-sm-9 ">
                                <div class="custom-file mt-auto">
                                    <input type="file" class="form-control cs" id="image" name="image">
                                    <input type="hidden" class="form-control" id="prod_id" name="prod_id"
                                        value="{{ $p->id }}">
                                </div>
                            </div>
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

<script>
$('#category_id').on('change', function(e) {
    console.log(e);
    var cat_id = e.target.value;
    $.get('/admin/product/subcat?cat_id=' + cat_id, function(data) {
        $('#sub_category_id').empty();
        $.each(data, function(index, subcatObj) {
            $('#sub_category_id').append('<option value="' + subcatObj.id + '">' + subcatObj
                .sub_category_name + '</option');
        });
    });
});
</script>
@endsection