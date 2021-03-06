<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? '-' }} | Ayocekin</title>

    <link rel="icon" type="image/png" href="{{ url('') }}/assets_landing/images/logo.png">

    {{-- <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;700;800;900&amp;display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;700;800;900&display=swap" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/css/style.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/css/responsive.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/css/night-mode.css" rel="stylesheet">

    <link href="{{ url('') }}/assets_landing/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    @yield('css-library')
    <style>
        .wrapper {
            background: #F9F9FF;
        }
        .navbar {
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }
        .btn-custom-1 {
            background: #1479C9;
            color: #fff !important;
        }
        .background-color-primary {
            background: #1479C9 !important;
            color: #FFF;
        }
        .background-color-secondary {
            background: #418FD1 !important;
            color: #FFF;
        }
        .background-color-support {
            background: #F5D62C !important;
            color: #FFF;
        }
        .text-color-primary {
            color: #1479C9 !important;
        }
        .text-color-secondary {
            color: #F5D62C !important;
        }
        .br-25 {
            border-radius: 25px;
        }
        .br-30 {
            border-radius: 30px;
        }
        .content-header h3 {
            font-size: 36px;
            font-weight: 800;
        }
    </style>
    @yield('css')
</head>

<body>
    <header class="header clearfix">
        <div class="header-inner">
            <nav class="navbar navbar-expand-lg bg-micko micko-head justify-content-sm-start micko-top pt-0 pb-0">
                <div class="container">
                    <button class="navbar-toggler align-self-start" type="button">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <a class="navbar-brand order-1 order-lg-0 ml-lg-0 ml-2 me-auto" href="{{ url('/') }}">
                        <div class="res_main_logo">
                            <img src="{{ url('') }}/assets_landing/images/logo.png" alt="">
                        </div>
                        <div class="main_logo" id="logo">
                            <img src="{{ url('') }}/assets_landing/images/logo-tulisan.png" alt="" style="width: 5%;"">
                            <img class="logo-inverse" src="{{ url('') }}/assets_landing/images/logo.png" alt="">
                        </div>
                    </a>
                    <div class="collapse navbar-collapse bg-micko-nav p-3 p-lg-0 mt-6 mt-lg-0 d-flex flex-column flex-lg-row flex-xl-row justify-content-lg-end mobileMenu" id="navbarSupportedContent">
                        <ul class="navbar-nav align-self-stretch">
                            <li class="nav-item">
                                <a class="nav-link text-color-primary fw-bold" href="{{ url('/') }}">Home</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link text-color-primary fw-bold" href="{{ url('/') }}">Produk</a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link text-color-primary fw-bold" href="{{ url('/contact') }}">Kontak</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-color-primary fw-bold" href="{{ url('/about') }}">Tentang</a>
                            </li>

                            {{-- @if (session()->get('role') == 1)
                            @endif --}}
                            
                            @if (session()->get('isLogin') == 1)
                                <li class="nav-item">
                                    <a class="nav-link text-color-primary fw-bold" href="{{ url('/setting/profile') }}">Profil</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-custom-1" href="{{ url('logout') }}">Logout</a>
                                </li>
                            @else 
                                <li class="nav-item">
                                    <a class="nav-link text-color-primary fw-bold" href="{{ url('register') }}">Daftar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white btn-custom-1" href="{{ url('login') }}">Masuk</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @if (session()->get('is_login') == true)
                    {{-- @if (session()->get('isLogin') == 1) --}}
                    <div class="msg-noti-acnt-section order-2">
                        <ul class="mn-icons-set align-self-stretch">
                            <li class="mn-icon dropdown dropdown-account">
                                <a href="#" class="opts_account" role="button" data-bs-toggle="dropdown">
                                    <img src="{{ url('') }}/assets_landing/images/logo.png" alt="">
                                    <i class="fas fa-caret-down arrow-icon"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-account dropdown-menu-end">
                                    <li class="media-list">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="ft-plus-square icon-bg-circle bg-cyan mr-0" src="{{ url('') }}/assets_landing/images/left-imgs/img-1.jpg" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading text-16">Joginder Singh</h6>
                                                <p class="email-text font-small-3"><a href="https://gambolthemes.net/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="e3898c848a8d878691a3869b828e938f86cd808c8e">[email&#160;protected]</a></p>
                                                <a href="my_profile_timeline.html" class="view-p-link font-small-4">View Profile</a>
                                            </div>
                                        </div>
                                        <div class="night_mode_switch__btn">
                                            <a href="#" id="night-mode" class="btn-night-mode">
                                                <i class="far fa-moon"></i>Night mode
                                                <span class="btn-night-mode-switch">
                                                    <span class="uk-switch-button"></span>
                                                </span>
                                            </a>
                                        </div>
                                        <a href="my_profile_dashboard.html" class="item channel_item mt-2">Dashboard</a>
                                        <a href="cart.html" class="item channel_item">Cart<span class="badge-cart">4</span></a>
                                        <a href="upload.html" class="item channel_item">Upload</a>
                                        <a href="create.html" class="item channel_item">Create</a>
                                        <a href="setting.html" class="item channel_item">Setting</a>
                                        <a href="setting_security_privacy_setting.html" class="item channel_item">Privacy</a>
                                        <a href="ads.html" class="item channel_item">Advertising</a>
                                        <a href="help_center.html" class="item channel_item">Help Center</a>
                                        <a href="refunds.html" class="item channel_item">Refunds</a>
                                        <a href="setting_language.html" class="item channel_item mb-2">Language</a>
                                    </li>
                                    <li class="dropdown-menu-footer">
                                        <a class="dropdown-item-link text-link text-center" href="sign_in.html">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </nav>
            <div class="overlay"></div>
        </div>
    </header>

    <div class="wrapper">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <footer class="footer">
        <div class="footer-bottom-items">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-bottom-links">
                            <div class="footer-logo" id="logo-footer">
                                <a href="{{ url('/') }}"><img src="{{ url('') }}/assets_landing/images/logo-tulisan.png" alt=""></a>
                                <img class="logo-inverse" src="{{ url('') }}/assets_landing/images/dark-logo.png" alt="">
                            </div>
                            <div class="footer-description py-3">
                                
                            </div>
                            <div class="micko-copyright">
                                <p><i class="fas fa-copyright"></i>Copyright {{ date('Y') }}. All Right Reserved.</p>
                            </div>
                            {{-- <ul class="social-ft-links">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ url('') }}/assets_landing/js/jquery.min.js"></script>
    <script src="{{ url('') }}/assets_landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/assets_landing/vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.18/dist/sweetalert2.all.min.js"></script>
    @yield('js-library')
    <script src="{{ url('') }}/assets_landing/js/custom.js"></script>
    <script src="{{ url('') }}/assets_landing/js/night-mode.js"></script>
    <script>
        let baseUrl = '{{ url('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function countDown(duration, timer) {
            var sec = duration;
            if (sec < 10) {
                myTimer.innerHTML = "0" + sec;
            } else {
                myTimer.innerHTML = sec;
            }
            if (sec <= 0) {
                $("#myBtn").removeAttr("disabled");
                $("#myBtn").removeClass().addClass("btnEnable");
                $("#myTimer").fadeTo(2500, 0);
                myBtn.innerHTML = "Click Me!";
                return;
            }
            sec -= 1;
            window.setTimeout(countDown, 1000);
        }
    </script>
    @if ($message = session()->get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Selamat',
                text: '{{ $message }}',
            })
        </script>
    @endif
    @if ($message = session()->get('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Maaf',
                text: '{{ $message }}',
            })
        </script>
    @endif
    @yield('js')
</body>

</html>