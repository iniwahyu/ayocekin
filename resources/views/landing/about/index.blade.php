@extends( $appLanding )

@section('css-library')

@endsection

@section('css')

@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="content-header text-center">
            <h3 class="text-color-primary">Tentang <span class="text-color-secondary">Kami</span></h3>
        </div>
        <div class="card p-3 mt-4 shadow br-25">
            <p class="mb-0">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum debitis fugit aliquid doloribus maxime reiciendis hic? Earum animi voluptatem excepturi, recusandae aliquid sunt aspernatur tenetur similique. Porro blanditiis vitae ea?</p>
        </div>
        <div class="location text-center py-5">
            <p>
                <i class="fas fa-map-marker fa-3x text-color-primary"></i>
                <span class="text-color-primary" style="font-size: 2em; font-weight: bold; margin-left: 20px;"><b>Location On</b>: Brebes, Jawa Tengah</span>
            </p>
        </div>
        <div class="content-header text-center">
            <h3 class="text-color-primary">Benefit Yang Akan Didapatkan</h3>
        </div>
        <div class="benefit">
            <div class="card px-3 mt-3 shadow br-25">
                <p class="mb-0">
                    <i class="fas fa-check-circle"></i>
                    <span>Top up cepat hanya dalam hitungan detik!</span>
                </p>
            </div>
            <div class="card mt-3 px-3 shadow br-25">
                <p class="mb-0">
                    <i class="fas fa-check-circle"></i>
                    <span>Pilih metode pembayaran terbaik kamu!</span>
                </p>
            </div>
            <div class="card mt-3 px-3 shadow br-25">
                <p class="mb-0">
                    <i class="fas fa-check-circle"></i>
                    <span>Akun aman dan terpercaya!</span>
                </p>
            </div>
            <div class="card mt-3 px-3 shadow br-25">
                <p class="mb-0">
                    <i class="fas fa-check-circle"></i>
                    <span>Banyak promosi-promosi menarik menunggu kamu!</span>
                </p>
            </div>
            <div class="card mt-3 px-3 shadow br-25">
                <p class="mb-0">
                    <i class="fas fa-check-circle"></i>
                    <span>Siap melayani anda online 24/7!</span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
@endsection

@section('js')
<script>
    $(function() {
        
    });
</script>
@endsection