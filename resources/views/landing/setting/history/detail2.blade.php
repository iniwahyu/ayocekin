@extends( $appLanding )

@section('css-library')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('css')

@endsection

@section('content')
<div class="invoice clearfix">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-8 col-md-10">
                <div class="invoice-header" style="background: #0169C2;">
                    <div class="invoice-header-logo">
                        <img src="{{ url('assets_landing/images/logo-tulisan.png') }}" alt="invoice-logo" style="width: 100%; height: 60px;">
                    </div>
                    <div class="invoice-header-text">
                        <span>Invoice</span>
                    </div>
                </div>
                <div class="invoice-body">
                    <div class="invoice_date_info">
                        <ul>
                            <li>
                                <div class="vdt-list"><span>Date :</span>{{ $orders->create_time }}</div>
                            </li>
                            <li>
                                <div class="vdt-list"><span>Invoice No :</span>{{ $orders->kode_invoice }}</div>
                            </li>
                        </ul>
                    </div>
                    <div class="invoice_dts">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="invoice_title">Invoice</h2>
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>To :</h4>
                                    <ul>
                                        <li>
                                            <div class="vdt-list">{{ $orders->nama }}</div>
                                        </li>
                                        <li>
                                            <div class="vdt-list">{{ $orders->email }}</div>
                                        </li>
                                        <li>
                                            <div class="vdt-list">{{ $orders->phone }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="vhls140">
                                    <h4>Status :</h4>
                                    <ul>
                                        <li>
                                            <div class="vdt-list">Transaksi: {{ orderStatus($orders->status) }}</div>
                                        </li>
                                        <li>
                                            <div class="vdt-list">Pembayaran: {{ paymentStatus($orders->payment_status) }}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice_table">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Item ID</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="user_dt_trans">
                                                <p>{{ $orders->product_id }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="user_dt_trans">
                                                <p>1</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="user_dt_trans">
                                                <p>{{ $orders->game_name }} - {{ $orders->product_name }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="user_dt_trans">
                                                <p>{{ number_format($orders->harga) }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1"></td>
                                        <td colspan="3">
                                            <div class="user_dt_trans jsk1145">
                                                <div class="totalinv2">Invoice Total : Rp{{ number_format($orders->harga) }}</div>
                                                <p>Dibayar melalui {{ $orders->payment }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="invoice_footer">
                        <div class="leftfooter">
                            <p>Terima Kasih atas Pesanannya.</p>
                        </div>
                        <div class="righttfooter">
                            {{-- <a class="main-save-btn ml-auto color btn-hover" href="javascript:window.print();">Print</a> --}}
                        </div>
                    </div>
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