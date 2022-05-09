<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    <meta name="description" content="Gambolthemes">
    <meta name="author" content="Gambolthemes">
    <title>{{ $title ?? '-' }} | Ayocekin</title>

    <link rel="icon" type="image/png" href="images/fav.png">

    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;300;400;500;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/css/style.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/css/responsive.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/css/night-mode.css" rel="stylesheet">

    <link href="{{ url('') }}/assets_landing/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets_landing/vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
</head>

<body>

    <div class="form-wrapper">
        <div class="app-form">
            <div class="app-form-content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-md-10">
                            <div class="app-top-items">
                                <div class="app-top-left-logo">
                                    <img src="images/logo.png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-md-7">
                            @yield('content')
                        </div>
                    </div>
                </div>
                <div class="register_footer mt-50">
                    © {{ date('Y') }} Your Title. All rights reserved
                </div>
            </div>
        </div>
    </div>


    <script src="{{ url('') }}/assets_landing/js/jquery.min.js"></script>
    <script src="{{ url('') }}/assets_landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/assets_landing/vendor/OwlCarousel/owl.carousel.js"></script>
    <script src="{{ url('') }}/assets_landing/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
    <script src="{{ url('') }}/assets_landing/js/custom.js"></script>
    <script src="{{ url('') }}/assets_landing/js/night-mode.js"></script>
</body>
</html>