<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>Sign In | PlainAdmin Demo</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
    <!-- ======== main-wrapper start =========== -->
    <main class="container">
        <!-- ========== signin-section start ========== -->
        <section class="signin-section py-5">

            <div class="row g-0 auth-row shadow">
                <div class="col-lg-6">
                    <div class="auth-cover-wrapper bg-primary-100">
                        <div class="auth-cover">
                            <div class="title text-center">
                                <h1 class="text-primary mb-10">Welcome Back</h1>
                                <p class="text-medium">
                                    Sign in to your Existing account to continue
                                </p>
                            </div>
                            <div class="cover-image">
                                <img src="assets/images/auth/signin-image.svg" alt="" />
                            </div>
                            <div class="shape-image">
                                <img src="assets/images/auth/shape.svg" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <div class="signin-wrapper">
                        <div class="form-wrapper">
                            @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            @endif
                            @if(session()->has('loginError'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('loginError') }}
                                <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            @endif
                            <h6 class="mb-15">Sign In Form</h6>
                            <p class="text-sm mb-25">
                                Start creating the best possible user experience for you
                                customers.
                            </p>
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Email </label>
                                            <input type="text" placeholder="Email" name="email"
                                                class="@error('email') is-invalid @enderror" value="{{old('email')}}"
                                                required autofocus />
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Password</label>
                                            <input type="password" placeholder="Password" name="password" />
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <!-- end col -->
                                    <div class="col-xxl-6 col-lg-12 col-md-6">
                                        <div class="text-start text-md-end text-lg-start text-xxl-end mb-30">
                                            <a href="#0">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="button-group d-flex justify-content-center flex-wrap">
                                            <button class="main-btn primary-btn btn-hover w-100 text-center">
                                                Sign In
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-center text-lg-center  mt-3">
                                        <a href="register">Register Now</a>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </section>
        <!-- ========== signin-section end ========== -->
    </main>
    <!-- ======== main-wrapper end =========== -->
    <!-- ========= All Javascript files linkup ======== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>