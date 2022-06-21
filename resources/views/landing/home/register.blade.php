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
                    <h4 class="mb-0">Halaman Register</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="iUsername" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" name="username" placeholder="Username" autofocus required >
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label>Password</label>
                        <input type="password" id="iPassword" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="****" autofocus required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label>Confirm Password</label>
                        <input type="password" id="iPassword" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="****" autofocus required>
                        {{-- @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror --}}
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="iEmail" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email" autofocus required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>No. Handphone</label>
                        <input type="number" id="iPhone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" placeholder="No. Handphone" autofocus required>
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
    $(function() {

    })

    function phoneIndonesia(phoneNumber) {
        if (phoneNumber.length <= 11) {
            console.log('Minimal 11 Karakter');
            return false;
        }
        if (phoneNumber.length > 14) {
            console.log('Maksimal 14 Karakter');
            return false;
        }
        if (phoneNumber.substring(0, 2) != '62') {
            console.log('Format Nomor harus Menggunakan 62 di awal');
            return false;
        }
    }

    function validTel(str){
        str = str.replace(/[^0-9]/g, '');
        var l = str.length;
        if(l<10) return ['error', 'Tel number length < 10'];
        
        var tel = '', num = str.substr(-7),
            code = str.substr(-10, 8),
            coCode = '';
        if(l>10) {
            coCode = str.substr(0, (l-10) );
        }
        tel = coCode +' ('+ code +') '+ num;
        
        return ['succes', tel];
    }

    function checkNumber(phoneNumber) {
        // let regex = "";
        // let phone = phoneNumber.match(/^(\+{0,})(\d{0,})([(]{1}\d{1,3}[)]{0,}){0,}(\s?\d+|\+\d{2,3}\s{1}\d+|\d+){1}[\s|-]?\d+([\s|-]?\d+){1,2}(\s){0,}$/gm);
        let phone = phoneNumber.match('^([0|+[0-9]{1,5})?([7-9][0-9]{9})$');
        if (phone) {
            console.log('cocok');
            return true;
        } else {
            console.log('gacocok');
            return false;
        }
    }
</script>
@endsection