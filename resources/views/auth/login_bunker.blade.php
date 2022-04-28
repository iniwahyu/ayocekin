
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Title -->
    <title>Neptune - Responsive Admin Dashboard Template</title>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ url('') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">

    <!-- Theme Styles -->
    <link href="{{ url('') }}/assets/css/main.min.css" rel="stylesheet">
    <link href="{{ url('') }}/assets/css/custom.css" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('') }}/assets/images/neptune.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('') }}/assets/images/neptune.png" />
</head>
<body>
    <div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
        <div class="app-auth-background">

        </div>
        <div class="app-auth-container">
            <div class="logo">
                <a href="{{ url('') }}">Your Site</a>
            </div>
            <p class="auth-description">Silahkan masukkan Email dan Password</p>

            <form action="{{ url("bunker/login-proses") }}" method="post">
                @csrf
                <div class="auth-credentials m-b-xxl">
                    <label for="signInEmail" class="form-label">Username</label>
                    <input type="text" class="form-control m-b-md" id="signInEmail" name="username" autofocus required>
    
                    <label for="signInPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="signInPassword" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required>
                </div>
    
                <div class="auth-submit">
                    <button type="submit" class="btn btn-primary">Sign In</button>
                    <a href="javascript:void(0);" class="auth-forgot-password float-end">Forgot password?</a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Javascripts -->
    <script src="{{ url('') }}/assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="{{ url('') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ url('') }}/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="{{ url('') }}/assets/js/main.min.js"></script>
    <script src="{{ url('') }}/assets/js/custom.js"></script>
</body>
</html>