<?php  
    use App\Models\Order;
    use App\Models\OrderDetail; 
?>
<style>
* {
    font-family: 'Lora', serif;
}
</style>
<header class="header ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
                <div class="header-left d-flex align-items-center">
                    <div class="menu-toggle-btn mr-20">
                        <button id="menu-toggle" class="main-btn primary-btn btn-hover me-2">
                            <i class="lni lni-chevron-left fw-bold"></i>
                        </button>
                        <button id="menu-toggle" class="main-btn light-btn btn-hover" onclick="toggleFullscreen()">
                            <i class="lni lni-full-screen "></i>
                        </button>
                    </div>
                    <div class="header-search d-none d-md-flex">
                        <form action="#">
                            <input type="text" placeholder="Search..." />
                            <button><i class="lni lni-search-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-6">
                <div class="header-right">
                    <!-- notification start -->
                    <div class="notification-box ml-15 d-none d-md-flex">
                        <button class="dropdown-toggle header-button" type="button" id="notification"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="lni lni-alarm"></i>
                            <span>2</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notification">
                            <li>
                                <a href="#0">
                                    <div class="image">
                                        <img src="assets/images/lead/lead-6.png" alt="" />
                                    </div>
                                    <div class="content">
                                        <h6>
                                            John Doe
                                            <span class="text-regular">
                                                comment on a product.
                                            </span>
                                        </h6>
                                        <p>
                                            Lorem ipsum dolor sit amet, consect etur adipiscing
                                            elit Vivamus tortor.
                                        </p>
                                        <span>10 mins ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                    <div class="image">
                                        <img src="assets/images/lead/lead-1.png" alt="" />
                                    </div>
                                    <div class="content">
                                        <h6>
                                            Jonathon
                                            <span class="text-regular">
                                                like on a product.
                                            </span>
                                        </h6>
                                        <p>
                                            Lorem ipsum dolor sit amet, consect etur adipiscing
                                            elit Vivamus tortor.
                                        </p>
                                        <span>10 mins ago</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- notification end -->
                    <!-- message start -->
                    <div class="header-message-box ml-15 d-none d-md-flex">
                        <button class="dropdown-toggle header-button" type="button" id="message"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="lni lni-envelope"></i>
                            <span>3</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="message">
                            <li>
                                <a href="#0">
                                    <div class="image">
                                        <img src="assets/images/lead/lead-5.png" alt="" />
                                    </div>
                                    <div class="content">
                                        <h6>Jacob Jones</h6>
                                        <p>Hey!I can across your profile and ...</p>
                                        <span>10 mins ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                    <div class="image">
                                        <img src="assets/images/lead/lead-3.png" alt="" />
                                    </div>
                                    <div class="content">
                                        <h6>John Doe</h6>
                                        <p>Would you mind please checking out</p>
                                        <span>12 mins ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#0">
                                    <div class="image">
                                        <img src="assets/images/lead/lead-2.png" alt="" />
                                    </div>
                                    <div class="content">
                                        <h6>Anee Lee</h6>
                                        <p>Hey! are you available for freelance?</p>
                                        <span>1h ago</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- message end -->
                    <!-- filter start -->
                    <?php
                        $pesanan_utama = Order::where('user_id',Auth::user()->id)->where('status_order_id',1)->first();
                        $pesanan_detail = [];
                        if(!empty($pesanan_utama)){
                            $pesanan_detail =  OrderDetail::where('order_id',$pesanan_utama->id)->get();
                        }
                    ?>
                    @if($pesanan_detail != null)
                    <div class="header-message-box ml-15 d-md-flex">
                        <button class="dropdown-toggle header-button" type="button" id="cart" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="lni lni-cart"></i>
                            <span>{{ $pesanan_detail->count() }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end  shadow-sm" aria-labelledby="cart">
                            <li class="py-2 ">
                                <div href="#" class="justify-content-between cart">
                                    <h6>Cart #{{$pesanan_utama->invoice_id}} </h6>
                                </div>
                            </li>
                            @foreach($pesanan_detail as $pd)
                            <li class="py-2">
                                <div href="#" class="align-items-center cart ">
                                    <div class="image">
                                        <img src="https://www.spheretheme.com/html/steam/assets/images/dishes/03.jpg"
                                            alt="" />
                                    </div>
                                    <div class="content d-flex justify-content-between align-items-center">
                                        <div class="content">
                                            <h6>{{ $pd->quantity }} x {{ $pd->product->name }} </h6>
                                            <p>Rp. <b
                                                    class="text-primary">{{ number_format($pd->total_harga,2,',','.') }}</b>
                                            </p>
                                        </div>
                                        <button role="button" class="btn bg-transparent"
                                            onclick="window.location.href='/delcart/{{$pd->id}}'"><i
                                                class="fa fa-trash text-danger " aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            <li class="py-2">
                                <div href="#" class="justify-content-between cart">
                                    <h6>Total Price</h6>
                                    <h5>Rp. <span class="text-primary">
                                            {{ number_format($pesanan_utama->total_harga,2,',','.') }}
                                        </span>
                                    </h5>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="d-flex">
                                    <button onclick="window.location.href='/cart';"
                                        class="btn btn-outline-primary me-2 w-100 fw-bold ">
                                        Cart Page
                                    </button>
                                    <button href="/checkout" class="btn btn-primary w-100 fw-bold btn-hover">
                                        Checkout
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @else
                    <div class="header-message-box ml-15 d-md-flex">
                        <button class="dropdown-toggle header-button" type="button" id="cart" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="lni lni-cart"></i>
                            <span>0</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end  shadow-sm" aria-labelledby="cart">
                            <li class="py-2 ">
                                <div href="#" class="justify-content-between cart">
                                    <h6>Empty Cart </h6>
                                </div>
                            </li>
                            <li class="py-2">
                                <div class="d-flex">
                                    <button onclick="window.location.href='/cart';"
                                        class="btn btn-outline-primary me-2 w-100 fw-bold ">
                                        Cart Page
                                    </button>
                                    <button onclick="window.location.href='/checkout';"
                                        class="btn btn-primary w-100 fw-bold btn-hover">
                                        Checkout
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    @endif
                    <!-- filter end -->
                    <!-- profile start -->
                    <div class="profile-box ml-15">
                        <button class="dropdown-toggle bg-transparent border-0 header-button" type="button" id="profile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="profile-info">
                                <div class="info">
                                    <h6 class="d-none d-md-flex"> {{ Auth::user()->name }}</h6>
                                    <div class="image">
                                        <img src="{{url('')}}/storage/{{auth()->user()->photo}}" alt="" />
                                        <span class="status"></span>
                                    </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                            <li>
                                <a href="/account/edit">
                                    <i class="lni lni-pencil"></i> Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="/account/change_password">
                                    <i class="lni lni-key"></i> Change Password
                                </a>
                            </li>
                            <li>
                                <a href="#0"> <i class="lni lni-list"></i> Log Aktivitas </a>
                            </li>
                            <li>
                                <a href="/logout"> <i class="lni lni-exit"></i> Log Out </a>
                            </li>
                        </ul>
                    </div>
                    <!-- profile end -->
                </div>
            </div>
        </div>
    </div>
</header>
<script>
function toggleFullscreen(event) {
    var element = document.documentElement;

    if (event instanceof HTMLElement) {
        element = event;
    }

    var isFullscreen = document.webkitIsFullScreen || document.mozFullScreen || false;

    element.requestFullScreen = element.requestFullScreen || element.webkitRequestFullScreen || element
        .mozRequestFullScreen || function() {
            return false;
        };
    document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document
        .mozCancelFullScreen || function() {
            return false;
        };

    isFullscreen ? document.cancelFullScreen() : element.requestFullScreen();
}
</script>