<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo py-3">
        <a href="index.html">
            <h4 class="text-primary fw-bold"><i class="fa fa-code fw-bold" aria-hidden="true"></i> BLUE <span
                    class="text-dark">
                    CanTEEN</span></h4>
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item nav-item-has-children">
                <a href="#0" data-bs-toggle="collapse" data-bs-target="#ddmenu_1" aria-controls="ddmenu_1"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22">
                            <path
                                d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z" />
                        </svg>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
                <ul id="ddmenu_1" class="collapse dropdown-nav">
                    <li>
                        @if(auth()->user()->role_id == 1)
                        <a href="/dashboard" class="active"> Dashboard </a>
                        @else
                        <a href="/admin/dashboard" class="active"> Dashboard </a>
                        @endif
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
                    aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.8334 1.83325H5.50008C5.01385 1.83325 4.54754 2.02641 4.20372 2.37022C3.8599 2.71404 3.66675 3.18036 3.66675 3.66659V18.3333C3.66675 18.8195 3.8599 19.2858 4.20372 19.6296C4.54754 19.9734 5.01385 20.1666 5.50008 20.1666H16.5001C16.9863 20.1666 17.4526 19.9734 17.7964 19.6296C18.1403 19.2858 18.3334 18.8195 18.3334 18.3333V7.33325L12.8334 1.83325ZM16.5001 18.3333H5.50008V3.66659H11.9167V8.24992H16.5001V18.3333Z" />
                        </svg>
                    </span>
                    <span class="text">Pages</span>
                </a>
                <ul id="ddmenu_2" class="collapse dropdown-nav">
                    <li>
                        <a href="settings.html"> Settings </a>
                    </li>
                    <li>
                        <a href="blank-page.html"> Blank Page </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item ">
                <a href="invoice.html">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.4166 7.33333C18.9383 7.33333 20.1666 8.56167 20.1666 10.0833V15.5833H16.4999V19.25H5.49992V15.5833H1.83325V10.0833C1.83325 8.56167 3.06159 7.33333 4.58325 7.33333H5.49992V2.75H16.4999V7.33333H17.4166ZM7.33325 4.58333V7.33333H14.6666V4.58333H7.33325ZM14.6666 17.4167V13.75H7.33325V17.4167H14.6666ZM16.4999 13.75H18.3333V10.0833C18.3333 9.57917 17.9208 9.16667 17.4166 9.16667H4.58325C4.07909 9.16667 3.66659 9.57917 3.66659 10.0833V13.75H5.49992V11.9167H16.4999V13.75ZM17.4166 10.5417C17.4166 11.0458 17.0041 11.4583 16.4999 11.4583C15.9958 11.4583 15.5833 11.0458 15.5833 10.5417C15.5833 10.0375 15.9958 9.625 16.4999 9.625C17.0041 9.625 17.4166 10.0375 17.4166 10.5417Z" />
                        </svg>
                    </span>
                    <span class="text ">Invoice</span>
                </a>
            </li>
            <li class="nav-item ">
                <a href="/product">
                    <i class="lni lni-pizza h4 text-muted" aria-hidden="true"></i>
                    <span class="text ps-3">Products</span>
                </a>
            </li>
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#cartmenu"
                    aria-controls="cartmenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-cart h3"></i>
                    </span>
                    <span class="text">Cart Menu</span>
                </a>
                <ul id="cartmenu" class="collapse dropdown-nav">
                    <li>
                        <a href="/cart"> Cart Page </a>
                    </li>
                    <li>
                        <a href="/checkout"> Checkout </a>
                    </li>
                </ul>
            </li>
            <span class="divider">
                <hr />
            </span>
            @if(auth()->user()->role_id == 1)
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#usermenu"
                    aria-controls="usermenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-user h3"></i>
                    </span>
                    <span class="text">User Menu</span>
                </a>
                <ul id="usermenu" class="collapse dropdown-nav">
                    <li>
                        <a href="/user/transaction">Transaction History </a>
                    </li>
                    <li>
                        <a href="/checkout">Log Activity </a>
                    </li>
                </ul>
            </li>
            @elseif(auth()->user()->role_id == 2)
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#usermenu"
                    aria-controls="usermenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="lni lni-user h3"></i>
                    </span>
                    <span class="text">Admin Menu</span>
                </a>
                <ul id="usermenu" class="collapse dropdown-nav">
                    <li>
                        <a href="/admin/order">Active Order</a>
                    </li>
                    <li>
                        <a href="/admin/transaction">Transaction Management</a>
                    </li>
                    <li>
                        <a href="/admin/category">Category Management</a>
                    </li>
                    <li>
                        <a href="/admin/sub_category">Sub Category Management</a>
                    </li>
                    <li>
                        <a href="/admin/product">Product Management</a>
                    </li>
                    <li>
                        <a href="/admin/user">User Management</a>
                    </li>
                    <li>
                        <a href="/admin/payment">Payment Method Management</a>
                    </li>

                </ul>
            </li>
            @endif
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#accountmenu"
                    aria-controls="accountmenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <i class="fa fa-address-card h3" aria-hidden="true"></i>
                    </span>
                    <span class="text">Account Menu</span>
                </a>
                <ul id="accountmenu" class="collapse dropdown-nav">
                    <li>
                        <a href="/account/edit">Edit Profile</a>
                    </li>
                    <li>
                        <a href="/account/change_password">Change Password</a>
                    </li>
                </ul>
            </li>
            <span class="divider">
                <hr />
            </span>
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_4"
                    aria-controls="ddmenu_4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.66675 4.58325V16.4999H19.2501V4.58325H3.66675ZM5.50008 14.6666V6.41659H8.25008V14.6666H5.50008ZM10.0834 14.6666V11.4583H12.8334V14.6666H10.0834ZM17.4167 14.6666H14.6667V11.4583H17.4167V14.6666ZM10.0834 9.62492V6.41659H17.4167V9.62492H10.0834Z" />
                        </svg>
                    </span>
                    <span class="text">UI Elements </span>
                </a>
                <ul id="ddmenu_4" class="collapse dropdown-nav">
                    <li>
                        <a href="alerts.html"> Alerts </a>
                    </li>
                    <li>
                        <a href="buttons.html"> Buttons </a>
                    </li>
                    <li>
                        <a href="cards.html"> Cards </a>
                    </li>
                    <li>
                        <a href="typography.html"> Typography </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="tables.html">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M4.58333 3.66675H17.4167C17.9029 3.66675 18.3692 3.8599 18.713 4.20372C19.0568 4.54754 19.25 5.01385 19.25 5.50008V16.5001C19.25 16.9863 19.0568 17.4526 18.713 17.7964C18.3692 18.1403 17.9029 18.3334 17.4167 18.3334H4.58333C4.0971 18.3334 3.63079 18.1403 3.28697 17.7964C2.94315 17.4526 2.75 16.9863 2.75 16.5001V5.50008C2.75 5.01385 2.94315 4.54754 3.28697 4.20372C3.63079 3.8599 4.0971 3.66675 4.58333 3.66675ZM4.58333 7.33341V11.0001H10.0833V7.33341H4.58333ZM11.9167 7.33341V11.0001H17.4167V7.33341H11.9167ZM4.58333 12.8334V16.5001H10.0833V12.8334H4.58333ZM11.9167 12.8334V16.5001H17.4167V12.8334H11.9167Z" />
                        </svg>
                    </span>
                    <span class="text">Tables</span>
                </a>
            </li>
            <span class="divider">
                <hr />
            </span>

            <li class="nav-item">
                <a href="notification.html">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.16667 19.25H12.8333C12.8333 20.2584 12.0083 21.0834 11 21.0834C9.99167 21.0834 9.16667 20.2584 9.16667 19.25ZM19.25 17.4167V18.3334H2.75V17.4167L4.58333 15.5834V10.0834C4.58333 7.24171 6.41667 4.76671 9.16667 3.94171V3.66671C9.16667 2.65837 9.99167 1.83337 11 1.83337C12.0083 1.83337 12.8333 2.65837 12.8333 3.66671V3.94171C15.5833 4.76671 17.4167 7.24171 17.4167 10.0834V15.5834L19.25 17.4167ZM15.5833 10.0834C15.5833 7.51671 13.5667 5.50004 11 5.50004C8.43333 5.50004 6.41667 7.51671 6.41667 10.0834V16.5H15.5833V10.0834Z" />
                        </svg>
                    </span>
                    <span class="text">Notifications</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>