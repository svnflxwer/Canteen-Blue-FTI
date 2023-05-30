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
        <!-- ========== title-wrapper end ========== -->
    </div>
    <!-- End Row -->
    <div class="container-fluid">
        <div class="row">

            <!-- End Col -->
            <div class="col-lg-12">
                <div class="card mb-30 bg-dark text-white">
                    <img src="https://b.zmtcdn.com/data/pictures/1/19574211/38f067e407d6bb9159cd1c5e1b0f288a.jpg"
                        class="card-img">
                    <div class="card-img-overlay h-100 d-flex flex-column" style="background-color:rgba(0,0,0,0.5);">
                        <div class="mx-auto my-auto text-center">
                            <h1 class="text-white mb-3">Best Product on this week</h1>
                            <h3 class="card-text text-white mb-3">Meal Santri</h3>
                            <p class="card-text">Makanan cepat saji</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Col -->
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- End Col -->
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <h4 class="text-medium my-3 mb-4 text-center">Our Popular Product</h4>
                    <hr class="mb-5">
                    <section class="center slider mb-4">
                        @foreach($best_products as $p)
                        <a role="button" data-bs-toggle="modal" data-bs-target="#productModal{{$p->id}}" class="card">
                            <img src="{{url('storage')}}/{{ $p->photo }}" class="card-img-top " alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $p->name }}</h5>
                                <p class="card-text text-dark"><small> Some quick example text to build on the card
                                        title</small>
                                </p>
                                <strong class="text-primary">Rp. {{ number_format($p->price,2,',','.') }}</strong>
                            </div>
                        </a>
                        @endforeach
                    </section>
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <div class="container-fluid">
        <div class="row ">

            <!-- End Col -->
            <div class="col-lg-12 ">
                <div class="card-style">
                    <h4 class="text-medium my-3 mb-4 text-center">Our Menu</h4>
                    <hr class="mb-4 d-block mx-auto" width="10%">
                    <div class="row mb-4">
                        <div class="filter col-md-7 d-flex">
                            <a href="/product" class="btn btn-outline-primary w-100 me-3">All</a>
                            @foreach($categories as $c)
                            <a href="?sc={{$c->slug}}"
                                class="btn btn-outline-primary w-100 me-3">{{ $c->sub_category_name }}</a>
                            @endforeach
                        </div>
                        <div class="search col-md-5">
                            <form class="d-flex" action="/product">
                                @if(request('sc'))
                                <input type="hidden" name="sc" value="{{request('sc')}}">
                                @endif
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                                    name="search" value="{{ request('search') }}">
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="row g-4 mb-4 justify-content-center" id="products">
                        @foreach($products as $p)
                        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 ">
                            <div class="card ">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{url('storage')}}/{{ $p->photo }}" class="img-fluid rounded-start "
                                            alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a role="button" data-bs-toggle="modal"
                                                    data-bs-target="#productModal{{$p->id}}">
                                                    <h5 class="card-title">{{ $p->name }}</h5>
                                                </a>

                                            </div>
                                            <p class="fw-bold">{{ $p->sub_category->sub_category_name }}</p>
                                            <p class="text-primary"><small
                                                    class="fw-bold">Rp.{{ number_format($p->price,2,',','.') }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="see-more btn btn-primary px-5 py-2" data-page="2"
                            data-link="{{ url('') }}/product?page=" data-div="#products">See more</button>
                    </div>
                </div>
            </div>
            <!-- End Col -->
        </div>

        <!-- End Row -->
    </div>
    <!-- end container -->
</section>

<!-- Modal Start -->
<!-- Button trigger modal -->


<!-- Modal -->
@foreach($best_products as $p)
<div class="modal fade " id="productModal{{$p->id}}" tabindex="-1" aria-labelledby="productModalLabel"
    aria-hidden="true">
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
                        <h2 class="fw-bold text-dark">{{ $p->name }}</h2>
                        <h5 class="fw-bold my-3 text-dark">Price : <span class="h4 text-primary">Rp.
                                {{ number_format($p->price,2,',','.') }}</span>
                        </h5>
                        <p class="text-muted text-justify lh-md mb-3">{{ $p->description }}</p>
                        <form action="/order/{{$p->id}}" method="post">
                            @csrf
                            <h5 class="fw-bold mb-2 text-dark">Quantity</h5>
                            <div class="input-group w-25 mb-3 d-flex align-items-center">
                                <a type="button" class="quantity-left-minus{{$p->id}} h4 btn bg-transparent"
                                    data-type="minus" data-field="">
                                    <i class="fa fa-caret-left " aria-hidden="true"></i>
                                </a>
                                <input type="number" id="quantity{{$p->id}}" name="quantity"
                                    class="form-control input-number " value="1" min="1" max="100">

                                <a type="button" class="quantity-right-plus{{$p->id}} h4 btn bg-transparent"
                                    data-type="plus" data-field="">
                                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                                </a>
                            </div>
                            <h5 class="fw-bold mb-2 text-dark">Additional Information</h5>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="keterangan"
                                    style="height: 100px" name="keterangan"></textarea>
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

<script type="text/javascript">
$(document).ready(function() {
    $('.quantity-right-plus{{$p->id}}').click(function(e) {

        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity{{$p->id}}').val());

        // If is not undefined

        $('#quantity{{$p->id}}').val(quantity + 1);

    });

    $('.quantity-left-minus{{$p->id}}').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($('#quantity{{$p->id}}').val());
        // Increment
        if (quantity > 0) {
            $('#quantity{{$p->id}}').val(quantity - 1);
        }
    });

});
</script>

@endforeach
<!-- End Modal -->

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="assets/slick/slick.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
$(".see-more").click(function() {
    $div = $($(this).data('div')); //div to append
    $link = $(this).data('link'); //current URL

    $page = $(this).data('page'); //get the next page #
    $href = $link + $page; //complete URL
    $.get($href, function(response) { //append data
        $html = $(response).find("#products").html();
        $div.append($html);
    });

    $(this).data('page', (parseInt($page) + 1)); //update page #
});

$(".center").slick({
    draggable: true,
    infinite: true,
    slidesToShow: 4,
    arrows: false,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1000,
});
</script>
@endsection