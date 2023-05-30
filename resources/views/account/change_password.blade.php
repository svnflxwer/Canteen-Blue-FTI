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
                    <form method="post" action="/account/change_password">
                        @csrf
                        <h3 class="mb-25 fw-bold">Form Change Password</h3>
                        <div class="input-style-1">
                            <label>Old Password</label>
                            <input type="password" placeholder="Password" id="oldpass" name="oldpass" />
                        </div>
                        <div class="input-style-1">
                            <label>New Password</label>
                            <input type="password" placeholder="Password" id="password1" name="password1" />
                        </div>
                        <div class="input-style-1">
                            <label>Repeat New Password</label>
                            <input type="password" placeholder="Password" id="password2" name="password2" />
                        </div>
                        <div class="input-style-1 mb-2">
                            <button type="submit" class="main-btn btn-hover primary-btn ms-auto d-block">Submit</button>
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