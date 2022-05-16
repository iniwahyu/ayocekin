@extends( $appLanding )

@section('css-library')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="full-width">
            <div class="cart_headtte14m item-setting-top">
                <span class="color_bb"><i class="fas fa-info-circle"></i></span>
                <h4>Informasi Pesanan</h4>
            </div>
            <div class="checkout-billing-dt">
                <div class="main-form">
                    <div class="its_your item-setting-top">
                        <i class="fas fa-flag mr-3"></i>
                        <span class="bagde-text">Pesanan Anda belum terbayar, silahkan melakukan pembayaran sebelum batas waktu pembayaran.</span>
                    </div>
                    <div class="billing-details">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table">
                                    <tr>
                                        <th width="20%">GAME/PRODUK</th>
                                        <td>{{ $services->game_name }} - {{ $services->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">ID</th>
                                        <td>{{ session()->get('order')['user_id'] ?? null }} ({{ session()->get('order')['server_id'] ?? null }}) </td>
                                    </tr>
                                    <tr>
                                        <th width="20%">HARGA</th>
                                        <td>{{ number_format($services->harga) }}</td>
                                    </tr>
                                    <tr>
                                        <th width="20%">PEMBAYARAN</th>
                                        <td>
                                            @if ($paymentDetail->idPayment == 1)
                                                <span>PEMBAYARAN OTOMATIS</span>    
                                            @else
                                                <span>PEMBAYARAN MANUAL</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Payment --}}
<div class="row mt-3">
    <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="full-width">
            <div class="cart_headtte14m item-setting-top">
                <span class="color_bb"><i class="fas fa-credit-card"></i></span>
                <h4>Pembayaran</h4>
            </div>
            <div class="checkout-billing-dt">
                <div class="main-form">
                    <div class="its_your item-setting-top">
                        <i class="fas fa-flag mr-3"></i>
                        <span class="bagde-text">Pastikan Transfer sesuai nominal dan rekening yang tertera di bawah.</span>
                    </div>
                    <div class="billing-details">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="row justify-content-center">
                                    <div class="col-lg-4">
                                        <img src="{{ url('upload/bank/' . $paymentDetail->img) }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="payment-detail text-center py-3">
                                    <h5>{{ $paymentDetail->nama }}</h5>
                                    <h4>{{ $paymentDetail->rekening }} ({{ $paymentDetail->nama_pemegang }})</h4>
                                    <h3 class="mb-0" style="color: red;">{{ number_format($services->harga) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Upload --}}
<form action="{{ url("$url/paying") }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mt-3">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="full-width">
                <div class="cart_headtte14m item-setting-top">
                    <span class="color_bb"><i class="fas fa-credit-card"></i></span>
                    <h4>Upload Bukti</h4>
                </div>
                <div class="checkout-billing-dt">
                    <div class="main-form">
                        <div class="billing-details">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <input type="file" class="dropify" name="file" data-height="300" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-xl-12">
            <button type="submit" class="act-btn btn-hover">Proses Pemesanan</button>
        </div>
    </div>
</form>
@endsection

@section('js-library')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('js')
<script>
    $(function() {
        // Upload
        $(".dropify").dropify();
    });  
</script>
@endsection