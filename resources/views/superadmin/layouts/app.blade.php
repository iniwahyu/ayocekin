
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title -->
    <title>{{ $title ?? '-' }} | Ayocekin</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ url('') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    {{-- <link href="{{ url('') }}/assets/plugins/pace/pace.css" rel="stylesheet"> --}}
    @yield('css-library')
    
    <!-- Theme Styles -->
    <link href="{{ url('') }}/assets/css/main.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/css/custom.css" rel="stylesheet">
    <style>
        .text-color-primary {
            color: #0169C2;
        }
        .text-color-secondary {
            color: #F5D62C;
        }
    </style>
    @yield('css')
    
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('') }}/assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('') }}/assets/images/neptune.png" />
</head>
<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <div class="app-sidebar">
            @include('superadmin/layouts/sidebar')
        </div>
        <div class="app-container">
            @include('superadmin/layouts/header')
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container">
                        {{-- <div class="row">
                            <div class="col">
                                <div class="page-description">
                                    <h1>Dashboard</h1>
                                </div>
                            </div>
                        </div> --}}
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Javascripts -->
    <script src="{{ url('') }}/assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="{{ url('') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('') }}/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    {{-- <script src="{{ url('') }}/assets/plugins/pace/pace.min.js"></script> --}}
    <script src="{{ url('') }}/assets/plugins/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('') }}/assets/js/main.min.js"></script>
    @yield('js-library')
    <script src="{{ url('') }}/assets/js/custom.js"></script>
    <script>
        // Global
        let baseUrl = '{{ url('') }}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- Custom --}}
    <script>
        $(function() {
            $.getJSON(baseUrl + '/superadmin/dashboard/count-topup', (result) => {
                $("#countTopup").html(result.order_all);
                $("#countTopupProcess").html(result.order_process);
                $("#countTopupPending").html(result.order_pending);
            });
        });
    </script>
    @yield('js')
</body>
</html>