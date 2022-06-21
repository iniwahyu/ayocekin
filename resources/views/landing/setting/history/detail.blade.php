@extends( $appLanding )

@section('css-library')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card br-25">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 text-center">
                            <img src="{{ url('assets_landing/images/logo-tulisan.png') }}" alt="" style="width: 100px; height: 100px;">
                        </div>
                    </div>
                    <ul class="country_list">
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Kode Invoice</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ $orders->kode_invoice }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Status Pesanan</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ orderStatus($orders->status) }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Status Pembayaran</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ paymentStatus($orders->payment_status) }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Produk</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ $orders->game_name }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Layanan</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ $orders->product_name }}</span>
                                </div>
                            </div>
                        </li>
                        <h4 class="m-0 ps-3">Detail Pembeli</h4>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Nama Pembeli</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ $orders->nama }} ({{ $orders->username }})</span>
                                </div>
                            </div>
                        </li>
                        <h4 class="m-0 ps-3">Detail Pembayaran</h4>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Metode Pembayaran</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ $orders->payment }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Harga</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ rupiah($orders->harga ?? 0) }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Biaya Tambahan</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ rupiah($orders->bayar - $orders->harga) ?? 0 }}</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="country_item">
                                <div class="country_item_left">
                                    <span>Total Pembayaran</span>
                                </div>
                                <div class="country_item_right">
                                    <span>{{ rupiah($orders->bayar) ?? 0 }}</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap.min.js" integrity="sha512-F0E+jKGaUC90odiinxkfeS3zm9uUT1/lpusNtgXboaMdA3QFMUez0pBmAeXGXtGxoGZg3bLmrkSkbK1quua4/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('js')
<script>
    $(function() {
        
    });  
</script>
@endsection