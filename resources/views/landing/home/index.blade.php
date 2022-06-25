@extends( $appLanding )

@section('css-library')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('css')
<style>
    #product #product-body .card {
        background: linear-gradient(180deg, #0169C2 0%, #7ED4EF 100%);
        box-shadow: 0px 4px 35px rgba(0, 0, 0, 0.25);
        border-radius: 25px;
    }
    #product #product-body .card:hover {
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    }
    #product #product-body .card img {
        border-radius: 25px;
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
                @foreach ($banner as $b)
                    @if ($b->status=='on')
                        <li data-bs-target="" data-bs-slide-to="{{  $loop->iteration }}" class="{{ $loop->iteration == 1 ? 'active' : '' }}"></li>
                    @endif
                @endforeach
            </ol>
            
            <!-- Wrapper for carousel items -->
            <div class="carousel-inner">
                @foreach ($banner as $b)
                    @if ($b->status == 'on')
                        <div class="carousel-item {{ $loop->iteration == 1 ? 'active' : '' }}">
                            <img src="{{ url("") }}/upload/banner/{{ $b->img }}" class="d-block w-100" alt="Slide {{ $loop->iteration }}" style="border-radius: 30px; width: 100%; height: 350px;">
                        </div>
                    @endif
                @endforeach
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

{{-- Game --}}
<div id="product">
    <div class="row justify-content-center">
        <div class="col mb-30">
            <div id="product-header" class="content-header">
                <h3 class="text-center text-color-primary">Produk <span class="text-color-secondary">Kami</span></h3>
            </div>
        </div>
    </div>
    <div class="row row-cols-lg-5 justify-content-center" id="product-body">
        @foreach ($games as $game)
        <div class="col col-xl-2 col-lg-4 col-md-4 col-sm-6 col-6 mb-30">
            <a href="{{ url("/product/" . $game->slug) }}">
                <div class="card mb-30 h-100">
                    <div class="card-body p-0">
                        <img src="{{ url('upload/game/' . $game->img) }}" alt="" style="width: 100%;">
                        <div class="title text-center py-3 px-1">
                            <h5 class="card-title mb-0 fw-bold text-white">{{ $game->nama }}</h5>
                        </div>
                    </div>
                    <div class="card-footer" style="background: none; border-top: 0px;">
                        <h5 class="fw-bold" style="background: #FFF;padding: 5px;text-align: center;border-radius: 30px;">Top Up</h5>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

{{-- Testimonial --}}
{{-- <div id="testimonial">
    <div class="row justify-content-center">
        <div class="col mb-30">
            <div class="content-header">
                <h3 class="text-center text-color-primary">Testimonial <span class="text-color-secondary">Kami</span></h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="your-class p-3">
                <div class="card mx-3 radius">
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam odio quasi facilis illum, odit incidunt labore corrupti vitae vero nihil dignissimos est fugit tempora saepe mollitia neque accusamus eaque hic.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('js-library')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('js')
<script>
    $(function() {
        $('.your-class').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
    });
</script>
@endsection