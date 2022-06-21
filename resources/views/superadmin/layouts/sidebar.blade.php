<div class="logo">
    <a href="index.html" class="logo-icon"><span class="logo-text">Neptune</span></a>
    <div class="sidebar-user-switcher user-activity-online">
        <a href="#">
            <img src="{{ url('') }}/assets/images/avatars/avatar.png">
            <span class="activity-indicator"></span>
            <span class="user-info-text">Chloe<br><span class="user-state-info">On a call</span></span>
        </a>
    </div>
</div>

<div class="app-menu">
    <ul class="accordion-menu">
        <li class="active-page">
            <a href="{{ url('/superadmin/dashboard') }}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
        </li>
    </ul>
    <ul class="accordion-menu">
        @if (session()->get('role')==1)
            <li class="sidebar-title">
                Master
            </li>
            <li>
                <a href="{{ url('') }}/superadmin/game"><i class="material-icons-two-tone">cloud_queue</i>Game</a>
            </li>
            <li>
                <a href="{{ url('') }}/superadmin/game_produk"><i class="material-icons-two-tone">inbox</i>Produk Game</a>
            </li>
            {{-- <li>
                <a href="{{ url('') }}/superadmin/pembayaran"><i class="material-icons-two-tone">inbox</i>Cara Pembayaran</a>
            </li> --}}
            <li class="">
                <a href=""><i class="material-icons-two-tone">inbox</i>Cara Pembayaran<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                <ul class="sub-menu" style="">
                    <li>
                        <a href="{{ url('') }}/superadmin/bankManual">Pembayaran Bank</a>
                    </li>
                    <li>
                        <a href="{{ url('') }}/superadmin/payment_qrcode">Pembayaran QRCode</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ url('') }}/superadmin/banner"><i class="material-icons-two-tone">inbox</i>Banner</a>
            </li>
            <li class="sidebar-title">
                Pesanan
            </li>
            <li>
                <a href="{{ url('') }}/superadmin/order"><i class="material-icons-two-tone">done</i>Order Topup</a>
            </li>
            <li class="sidebar-title">
                Kelola Akun
            </li>
            <li>
                <a href="{{ url('') }}/superadmin/userrole"><i class="material-icons-two-tone">bookmark</i>User Role</a>
            </li>
            <li>
                <a href="{{ url('') }}/superadmin/user"><i class="material-icons-two-tone">bookmark</i>All User</a>
            </li>
            {{-- <li>
                <a href="#"><i class="material-icons-two-tone">bookmark</i>Profile</a>
            </li> --}}
            <li>
                <a href="{{ url('logout') }}"><i class="material-icons-two-tone">bookmark</i>Log Out</a>
            </li>
        @elseif (session()->get('role')==2)
            <li class="sidebar-title">
                Pesanan
            </li>
            <li>
                <a href="{{ url('') }}/superadmin/order"><i class="material-icons-two-tone">done</i>Order Topup</a>
            </li>
            <li class="sidebar-title">
                Kelola Akun
            </li>
            <li>
                <a href="{{ url('logout') }}"><i class="material-icons-two-tone">bookmark</i>Log Out</a>
            </li>
        @endif

        
    </ul>
</div>