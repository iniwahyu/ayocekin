@extends( $appLanding )

@section('css-library')

@endsection

@section('css')
<style>
    .card .ppuser-card {
        border-radius: 10px;
    }
    .card .active {
        border: 2px solid #70a1ff;
    }
    .card .services:hover {
        cursor: pointer;
    }
    .card .payment:hover {
        cursor: pointer;
    }
    .payment-detail .item {
        border: 1px solid #b9aec5;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
{{-- Product --}}
<div class="row">
    <div class="col-xl-3 col-md-12 col-sm-12">
        <div class="mb-30 text-center">
            <img src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/mlbb_tile.jpg" alt="" class="img-fluid">
            <div class="description text-start py-3">
                <h4>Mobile Legend</h4>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Neque reprehenderit praesentium sequi id amet similique soluta dolorum distinctio dolore? Optio eligendi ducimus mollitia nobis illum ipsa, fuga minima vero ex.</p>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-md-12 col-sm-12">
        <form action="" method="post">
            @csrf
            {{-- Data Game --}}
            <div class="full-width mb-30 card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Game</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-sm-12 mb-3">
                            <input type="text" class="form-control form-control-lg" name="user_id" placeholder="User ID" autofocus autocomplete="off" required>
                        </div>
                        <div class="col-xl-6 col-sm-12">
                            <input type="text" class="form-control form-control-lg" name="server_id" placeholder="Server Game" autocomplete="off" required>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Layanan --}}
            <div class="full-width mb-30 card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Layanan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @for ($i = 0; $i < 8; $i++)
                        <div class="col-xl-3 col-md-6 col-sm-12">
                            <div class="ppuser-card mb-2 services" data-id="{{ $i }}">
                                <div class="ppuser-img">
                                    <img class="ft-plus-square job-bg-circle bg-cyan mr-0" src="https://cdn1.codashop.com/S/content/common/images/denom-image/MLBB/100x100/50orless_MLBB_Diamonds.png" alt="">
                                </div>
                                <a href="#" class="job-heading text-center">{{ rand(1,999) }} Diamonds</a>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
    
            {{-- Payment --}}
            <div class="full-width mb-30 card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-sm-12">
                            <div class="ppuser-card mb-2 p-5 payment" data-id="1">
                                <h4 class="job-heading text-center">PEMBAYARAN OTOMATIS</h4>
                            </div>
                        </div>
                        <div class="col-xl-6 col-sm-12">
                            <div class="ppuser-card mb-2 p-5 payment" data-id="2">
                                <h4 class="job-heading text-center">PEMBAYARAN MANUAL</h4>
                            </div>
                        </div>
                    </div>

                    <div class="payment-detail my-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="item py-4">
                                    <div class="product-left">
                                        <a href="#"><img class="ft-plus-square product-bg-circle bg-cyan mr-0" src="https://cdn1.codashop.com/S/content/common/images/mno/GO_PAY_CHNL_LOGO.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="act-btn btn-hover">Selesaikan Pesanan</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js-library')

@endsection

@section('js')
<script>
    $(function() {
        // Layanan
        $(".services").on("click", function() {
            let dataId = $(this).data("id");

            var selected = $(".services");
            for (let i = 0; i < selected.length; i++) {
                selected[i].classList.remove("active");
            }
            $(this).addClass("active");
            // alert(dataId);
        });

        // Payment
        $(".payment").on("click", function() {
            let dataId = $(this).data("id");
            
            var selected = $(".payment");
            for (let i = 0; i < selected.length; i++) {
                selected[i].classList.remove("active");
            }
            $(this).addClass("active");
        });
    });  
</script>
@endsection