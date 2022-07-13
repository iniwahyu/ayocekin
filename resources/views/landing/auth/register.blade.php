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
        <div class="col col-xl-5">
            <div class="content-header mb-5">
                <h3 class="text-center text-color-primary">Register <span class="text-color-secondary">Akun</span></h3>
            </div>
            <div class="full-width mb-30 card">
                @if (session()->has('success'))
                    <div class="alert alert-success my-3" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger my-3" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="form-group mb-3">
                        <label>Username</label>
                        <input type="text" id="iUsername" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" placeholder="Username" value="{{ old('username') }}" autofocus required>
                        {!! $errors->has('username') ? '<div class="invalid-feedback">'.$errors->first('username').'</div>' : '' !!}
                    </div>
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password" id="iPassword" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" placeholder="************" required>
                        {!! $errors->has('password') ? '<div class="invalid-feedback">'.$errors->first('password').'</div>' : '' !!}
                    </div>
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email" id="iEmail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" placeholder="example@example.com" value="{{ old('email') }}" required>
                        {!! $errors->has('email') ? '<div class="invalid-feedback">'.$errors->first('email').'</div>' : '' !!}
                    </div>
                    <div class="form-group mb-3">
                        <label>No. Handphone</label>
                        <input type="number" id="iPhone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" name="phone" placeholder="Diawali dengan 628xxxxxxxxx" value="{{ old('phone') }}" required>
                        {!! $errors->has('phone') ? '<div class="invalid-feedback">'.$errors->first('phone').'</div>' : '' !!}
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="form-group">
                                <button type="submit" class="btn background-color-primary w-100 text-white">Daftar</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <p class="mb-0">Sudah Memiliki Akun? Silahkan <a href="{{ url('login') }}"><b>Login</b></a></p>
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