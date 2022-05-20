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
<form action="{{ url('register-proses') }}" method="post">
    @csrf
    <div class="row justify-content-center">
        <div class="col col-xl-6">
            <div class="full-width mb-30 card">
                <div class="card-header">
                    <h4 class="mb-0">Halaman Register</h4>
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
                        <button type="submit" class="main-save-btn color btn-hover">Daftar</button>
                    </div>
                    <p class="mb-0">Sudah punya akun? Silahkan <a href="{{ url('login') }}"><b>Login</b></a></p>
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