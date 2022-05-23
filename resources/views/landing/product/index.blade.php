@extends( $appLanding )

@section('css-library')

@endsection

@section('css')
<style>
    .card .ppuser-card {
        border-radius: 10px;
    }
    .active {
        border: 2px solid #70a1ff !important;
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
            {{-- <img src="https://cdn1.codashop.com/S/content/mobile/images/product-tiles/mlbb_tile.jpg" alt="" class="img-fluid"> --}}
            <img src="https://ayocekin.com/upload/game/{{ $games->img }}" class="img-fluid" alt="...">
            <div class="description text-start py-3">
                <h4>{{ $games->nama }}</h4>
                <p>{{ $games->deskripsi }}</p>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-md-12 col-sm-12">
        <form action="{{ url("payment/order") }}" method="post">
            @csrf
            {{-- Data Game --}}
            <div class="full-width mb-30 card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Game</h4>
                </div>
                @if ($games->qserver==1)
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
                @elseif ($games->qserver==2)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-12 mb-3">
                                <input type="text" class="form-control form-control-lg" name="user_id" placeholder="User ID" autofocus autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            {{-- Layanan --}}
            <div class="full-width mb-30 card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Layanan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-xl-3 col-md-6 col-sm-12">
                            <div class="ppuser-card mb-2 services" data-id="{{ $product->id }}">
                                <div class="ppuser-img">
                                    <img class="ft-plus-square job-bg-circle bg-cyan mr-0" src="{{ url('upload/game/produk/' . $product->img) }}" alt="">
                                </div>
                                <a href="#" class="job-heading text-center">{{ $product->nama }}</a>
                                <h5>Rp{{ number_format($product->harga) }}</h5>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-warning alert-action text-center">
                            <p class="text-white mb-0">Layanan Belum Tersedia. Mohon untuk menunggu</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
    
            @if (count($products)>0)
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
                                <div class="payment-detail-additional">
                                    {{-- <div class="col-sm-12">
                                        <div class="item py-4">
                                            <div class="product-left">
                                                <a href="#"><img class="ft-plus-square product-bg-circle bg-cyan mr-0" src="https://cdn1.codashop.com/S/content/common/images/mno/GO_PAY_CHNL_LOGO.png" alt=""></a>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="serviceDetail" name="services">
                        <input type="hidden" id="payment" name="payment">
                        <input type="hidden" id="paymentDetail" name="payment_detail">

                            
                        <button type="submit" class="act-btn btn-hover">Selesaikan Pesanan</button>
                            
                        
                    </div>
                </div>
            @endif
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
            $("#serviceDetail").val(dataId);

            var selected = $(".services");
            for (let i = 0; i < selected.length; i++) {
                selected[i].classList.remove("active");
            }
            $(this).addClass("active");
        });

        // Payment
        $(".payment").on("click", function() {
            let dataId = $(this).data("id");
            
            var selected = $(".payment");
            console.log("Payment: " + selected.length);
            for (let i = 0; i < selected.length; i++) {
                selected[i].classList.remove("active");
            }
            $(this).addClass("active");

            // Pass to input
            $("#payment").val(dataId);

            // Json
            $.getJSON(baseUrl + '/payment/get-list/' + dataId, (result) => {
                let html = '';
                $.each(result.data, (i, item) => {
                    html += '<div class="col-sm-12">';
                        html += '<div class="item py-4" data-id="'+item.id+'">';
                            html += '<div class="product-left">';
                                html += '<img class="ft-plus-square product-bg-circle bg-cyan mr-0" src="'+baseUrl+'/upload/bank/'+item.img+'" alt="">';
                            html += '</div>';
                            html += '<div class="product-body">';
                                html += '<p class="job-heading mb-0">'+item.nama+'</p>';
                                html += '<p class="mb-0">'+item.rekening+' - '+item.nama_pemegang+'</p>';
                            html += '</div>';
                        html += '</div>';
                    html += '</div>';
                }); 
                $(".payment-detail-additional").html(html);
            });

            $(".payment-detail-additional").on("click", ".item", function() {
                let dataId = $(this).data("id");
                console.log(dataId);
                $("#paymentDetail").val(dataId);

                var selected = $(".payment-detail-additional").find(".item").length;
                // var selected = $(this);
                console.log(selected);
                for (let i = 0; i < selected.length; i++) {
                    selected[i].classList.remove("active");
                }
                $(".payment-detail-additional").find(".item").addClass("active");
            });
        });
    });  
</script>
@endsection