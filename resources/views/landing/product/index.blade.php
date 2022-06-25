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
    .payment-method .item {
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
        <form action="{{ url("payment/order") }}" method="post" id="formSubmit">
            @csrf
            {{-- Data Game --}}
            <div class="full-width mb-30 card shadow">
                <div class="card-header">
                    <h4 class="card-title mb-0">Data Game  
                <span class="lightbox-example">
                    <a data-fslightbox="gallery" href="{{ url('') }}/upload/game/panduan/{{ $games->panduan }}">
                        <img class="img-fluid" style="width: 25px; height: 25px;" src="{{ url('assets/images/icons/ic_question.png') }}" alt="">
                    </a>
                </span>
                    
                    </h4>
                </div>
                @if ($games->qserver==1)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-12 mb-3">
                                <input type="text" class="form-control form-control-lg {!! $errors->has('user_id') ? 'is-invalid' : '' !!}" name="user_id" placeholder="User ID" autofocus autocomplete="off">
                                {!! $errors->has('user_id') ? '<div class="invalid-feedback">'.$errors->first('user_id').'</div>' : '' !!}
                            </div>
                            <div class="col-xl-6 col-sm-12">
                                <input type="text" class="form-control form-control-lg {!! $errors->has('server_id') ? 'is-invalid' : '' !!}" name="server_id" placeholder="Server Game" autocomplete="off">
                                {!! $errors->has('server_id') ? '<div class="invalid-feedback">'.$errors->first('server_id').'</div>' : '' !!}
                            </div>
                        </div>
                    </div>
                @elseif ($games->qserver==2)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-12 mb-3">
                                <input type="text" class="form-control form-control-lg {!! $errors->has('user_id') ? 'is-invalid' : '' !!}" name="user_id" placeholder="User ID" autofocus autocomplete="off">
                                {!! $errors->has('user_id') ? '<div class="invalid-feedback">'.$errors->first('user_id').'</div>' : '' !!}
                            </div>
                        </div>
                    </div>
                @elseif ($games->qserver==4)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-12 mb-3">
                                <input type="text" class="form-control form-control-lg {!! $errors->has('server_id') ? 'is-invalid' : '' !!}" name="server_id" placeholder="Server Game" autofocus autocomplete="off">
                                {!! $errors->has('server_id') ? '<div class="invalid-feedback">'.$errors->first('server_id').'</div>' : '' !!}
                            </div>
                        </div>
                    </div>
                @elseif ($games->qserver==5)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-12 mb-3">
                                <input type="text" class="form-control form-control-lg {!! $errors->has('kingdom') ? 'is-invalid' : '' !!}" name="kingdom" placeholder="Kingdom Game" autofocus autocomplete="off">
                                {!! $errors->has('kingdom') ? '<div class="invalid-feedback">'.$errors->first('kingdom').'</div>' : '' !!}
                            </div>
                            <div class="col-xl-6 col-sm-12">
                                <input type="text" class="form-control form-control-lg {!! $errors->has('user_id') ? 'is-invalid' : '' !!}" name="user_id" placeholder="ID Akun" autocomplete="off">
                                {!! $errors->has('user_id') ? '<div class="invalid-feedback">'.$errors->first('user_id').'</div>' : '' !!}
                            </div>
                            <div class="col-xl-6 col-sm-12 mb-3">
                                <input type="text" class="form-control form-control-lg {!! $errors->has('email_game') ? 'is-invalid' : '' !!}" name="email_game" placeholder="Email Game" autofocus autocomplete="off">
                                {!! $errors->has('email_game') ? '<div class="invalid-feedback">'.$errors->first('email_game').'</div>' : '' !!}
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
                    @if ($errors->has('services'))
                        <div class="alert alert-warning alert-action text-center">
                            <p class="text-white mb-0">Maaf! Silahkan Pilih Layanan Produk</p>
                        </div>
                    @endif
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
                        <div class="col-sm-12">
                            <div class="alert alert-warning alert-action text-center">
                                <p class="text-white mb-0">Layanan Belum Tersedia. Mohon untuk menunggu</p>
                            </div>
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
                        @if ($errors->has('payment'))
                            <div class="alert alert-warning alert-action text-center">
                                <p class="text-white mb-0">Maaf! Silahkan Pilih Metode Pembayaran</p>
                            </div>
                        @endif
                        <div class="row">
                            {{-- <div class="col-xl-6 col-sm-12">
                                <div class="ppuser-card mb-2 p-5 payment" data-id="1">
                                    <h4 class="job-heading text-center">PEMBAYARAN OTOMATIS</h4>
                                </div>
                            </div> --}}
                            <div class="col-xl-6 col-sm-12">
                                <div class="ppuser-card mb-2 p-5 payment" data-id="2">
                                    <h4 class="job-heading text-center">PEMBAYARAN MANUAL</h4>
                                </div>
                            </div>
                        </div>

                        <div class="payment-method my-2">
                            <div class="row">
                                <div class="payment-manual">
                                    @foreach ($paymentManual as $pm)
                                    <div class="col-sm-12 my-2">
                                        <div class="item payment-detail py-4" data-id="{{ $pm->id }}">
                                            <div class="product-left">
                                                <img class="ft-plus-square product-bg-circle bg-cyan mr-0" src="{{ url('upload/bank/' . $pm->img) }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <p class="job-heading mb-0">{{ $pm->nama }}</p>
                                                <p class="mb-0">{{ $pm->rekening }} - {{ $pm->nama_pemegang }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- @foreach ($paymentQr as $pq)
                                    <div class="col-sm-12 my-2">
                                        <div class="item payment-detail py-4" data-id="{{ $pm->id }}">
                                            <div class="product-left">
                                                <img class="ft-plus-square product-bg-circle bg-cyan mr-0" src="{{ url('upload/payment/qrcode/' . $pq->img) }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <p class="job-heading mb-0">{{ $pq->nama }}</p>
                                                <p class="mb-0">{{ $pm->rekening }} - {{ $pm->nama_pemegang }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach --}}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="serviceDetail" name="services">
                        <input type="hidden" class="form-control" id="payment" name="payment">
                        <input type="hidden" class="form-control" id="paymentDetail" name="payment_detail">
                        <button type="submit" class="act-btn btn-hover">Selesaikan Pesanan</button>
                    </div>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection

@section('js-library')
    <script src="{{ url('') }}/assets/plugins/lightbox/fslightbox.js"></script>
    <script src="{{ url('') }}/assets/js/pages/lightbox.js"></script>
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

        // Hide Payment Method
        $(".payment-manual").hide();

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
            
            if (dataId == '2') {
                $(".payment-manual").show();
            } else {
                $(".payment-manual").hide();
            }
        });

        // Payment Item
        $(".payment-detail").on("click", function() {
            let dataId = $(this).data("id");
            
            var selected = $(".payment-detail");
            console.log("Payment Detail: " + selected.length);
            for (let i = 0; i < selected.length; i++) {
                selected[i].classList.remove("active");
            }
            $(this).addClass("active");

            // Pass to input
            $("#paymentDetail").val(dataId);
        });
    });  
</script>
@endsection