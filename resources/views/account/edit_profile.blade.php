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

        <!-- End Row -->
        <div class="row">

            <!-- End Col -->
            <div class="col-lg-7">
                <div class="card-style mb-30">
                    <form method="post" action="/account/edit" enctype="multipart/form-data">
                        @csrf
                        <h3 class="mb-25 fw-bold">Account Information</h6>
                            <div class="input-style-1">
                                <label>Full Name</label>
                                <input type="text" placeholder="Full Name" id="name" name="name"
                                    value="{{ auth()->user()->name }}" required />
                            </div>
                            <div class="input-style-1">
                                <label>Username</label>
                                <input type="text" placeholder="Username" id="username" name="username"
                                    value="{{ auth()->user()->username }}" required />
                            </div>
                            <div class="input-style-1">
                                <label>Email</label>
                                <input type="text" placeholder="Email" value="{{ auth()->user()->email }}" disabled />
                            </div>
                            <div class="input-style-1">
                                <label>No Handphone</label>
                                <input type="text" placeholder="No Handphone" id="no_hp" name="no_hp"
                                    value="{{ auth()->user()->no_hp }}" required />
                            </div>
                            <div class="input-style-1">
                                <label>Address</label>
                                <textarea placeholder="Address" rows="5" name="address" id="address"
                                    value="{{ auth()->user()->address}}"></textarea>
                            </div>
                            <div class="form-group mb-25">
                                <div class="row align-items-end">
                                    <div class="col-sm-3">
                                        <img src="{{ url('') }}/storage/{{auth()->user()->photo}}" class="img-thumbnail"
                                            id="output">
                                    </div>
                                    <div class="col-sm-9 ">
                                        <div class="custom-file mt-auto">
                                            <input type="file" class="form-control cs" id="image" name="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-style-1">
                                <button type="submit"
                                    class="main-btn btn-hover primary-btn ms-auto d-block">Submit</button>
                            </div>
                    </form>
                    <!-- end input -->
                </div>
            </div>
            <div class="col-lg-5 ">
                <div class="card-style mb-30 text-center p-5">
                    <img src="{{ url('') }}/storage/{{auth()->user()->photo}}" alt=""
                        class="img-thumbnail rounded-circle mb-30 mx-5 mt-2">
                    <h3 class="fw-bold mb-10">{{ auth()->user()->name }}</h3>
                    <h5 class="text-muted mb-10">{{ auth()->user()->role->role_name }}</h5>
                    <h5 class="text-muted mb-10 fw-light">{{ auth()->user()->email }}</h5>
                </div>
            </div>
            <!-- End Col -->
        </div>

        <!-- End Row -->
    </div>
    <!-- end container -->
</section>
@endsection