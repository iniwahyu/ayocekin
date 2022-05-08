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
{{-- Carousel --}}
<div class="row">
    <div class="col col-xl-12 col-sm-12 mb-30">
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
                <li data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#myCarousel" data-bs-slide-to="2"></li>
            </ol>
            
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://topuppedia.com/upload/slide_master_20210816000141.jpg" class="d-block w-100" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="https://www.tutorialrepublic.com/examples/images/slide2.png" class="d-block w-100" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="https://www.tutorialrepublic.com/examples/images/slide3.png" class="d-block w-100" alt="Slide 3">
                </div>
            </div>
    
            <!-- Carousel controls -->
            <a class="carousel-control-prev" href="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</div>

{{-- List --}}
<h3>Produk</h3>
<div class="row product">
    @for ($i = 0; $i < 12; $i++)
    <div class="col col-xl-2 col-md-4 col-sm-4 col-xs-4">
        <a href="{{ url("/product/nama") }}">
            <div class="full-width card mb-30">
                <div class="card-body p-0">
                    <img src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/mlbb_tile.jpg" alt="" class="img-fluid">
                    <div class="title text-center p-3">
                        <h5 class="card-title mb-0">Mobile Legends</h5>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endfor
</div>
@endsection

@section('js-library')

@endsection

@section('js')
<script>
    
</script>
@endsection