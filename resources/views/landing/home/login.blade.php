@extends( $appLanding )

@section('css-library')

@endsection

@section('css')
<style>
    a .card:hover {
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    }
    .title .card-title {
        color: #000;
    }
</style>
@endsection

@section('content')
<form action="{{ url('login-proses') }}" method="post">
    @csrf
    <div class="row justify-content-center">
        <div class="col col-xl-6">
            <div class="full-width mb-30 card">

                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="card-header">
                    <h4 class="mb-0">Halaman Login</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="iUsername" class="form-control" name="username" placeholder="Username" autofocus required>
                    </div>
                    <div class="form-group mt-2">
                        <label>Password</label>
                        <input type="password" id="iPassword" class="form-control" name="password" placeholder="****" required>
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="main-save-btn color btn-hover">Login</button>
                    </div>
                    <p class="mb-0">Belum punya akun? Silahkan <a href="{{ url('register') }}"><b>Register</b></a></p>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js-library')

@endsection

@section('js')
<script>
    
</script>
@endsection