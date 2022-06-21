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
        <div class="col col-xl-5">
            <div class="content-header mb-5">
                <h3 class="text-center text-color-primary">Login <span class="text-color-secondary">Akun</span></h3>
            </div>
            <div class="mb-30 card">

                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Username</label>
                        <input type="text" id="iUsername" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" placeholder="Username" autofocus>
                        {!! $errors->has('username') ? '<div class="invalid-feedback">'.$errors->first('username').'</div>' : '' !!}
                    </div>
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" id="iPassword" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="********">
                        {!! $errors->has('password') ? '<div class="invalid-feedback">'.$errors->first('password').'</div>' : '' !!}
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="form-group">
                                <button type="submit" class="btn background-color-primary w-100 text-white">Login</button>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ url('forgot') }}"><b>Lupa Kata Sandi?</b></a>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p class="mb-0">Belum Memiliki Akun? <a href="{{ url('register') }}"><b>Daftar Sekarang</b></a></p>
                    </div>
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