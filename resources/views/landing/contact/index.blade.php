@extends( $appLanding )

@section('css-library')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('css')

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="content-header text-center">
            <h3 class="text-color-primary">Hubungi <span class="text-color-secondary">Kami</span></h3>
            <h5>Apakah Anda membutuhkan bantuan? Silahkan Hubungi Kami</h5>
        </div>
        <form action="{{ url("$url/store") }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Full Name / Nickname" required>
            </div>
            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" class="form-control form-control-lg" name="email" placeholder="example@mail.com" required>
            </div>
            <div class="form-group mb-3">
                <label>Pesan</label>
                <textarea cols="30" rows="4" class="form-control form-control-lg" name="message" placeholder="Tulis Pesan Kamu disini" required></textarea>
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-primary background-color-primary w-100">KIRIMKAN</button>
            </div>
        </form>

        <div class="my-5 text-center">
            <h5>Kontak Tambahan yang bisa Anda hubungi</h5>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <a href="mailto::support@ayocekin.com" target="_blank"><i class="fas fa-envelope"></i> Email</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body p-5">
                            <a href="https://api.whatsapp.com/send?phone=628xxxxx" target="_blank"><i class="fab fa-whatsapp"></i> Whatsapp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('js')
<script>
    $(function() {
        // $('.your-class').slick({
        //     infinite: true,
        //     slidesToShow: 3,
        //     slidesToScroll: 3
        // });
    });
</script>
@endsection