@extends( $appLanding )

@section('css-library')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('css')

@endsection

@section('content')
<div class="row">
    @include('landing/layouts/sidebar_setting')
    <div class="col-xl-9 col-lg-8 col-md-12">
        <div class="event-card rrmt-30">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="headtte14m item-setting-top">
                <span class="color_bb"><i class="fas fa-cog"></i></span>
                <h4>History</h4>
            </div>
            <div class="item-setting">
                @foreach ($orders as $order)
                <div class="jobs-list">
                    <div class="media invite125 d-md-flex">
                        <div class="job-left">
                            <img class="ft-plus-square et-plus-square2 bg-cyan me-0" src="{{ url('upload/game/' . $order->game_image) }}" alt="" style="width: 60px; height: 60px;">
                        </div>
                        <div class="media-body">
                            <a href="#" class="job-heading pt-0">{{ $order->game_name }} - {{ $order->product_name }}</a>
                            <p class="notification-text font-small-4">
                                <a href="{{ url("$url/detail/" . $order->kode_invoice) }}" target="_blank" class="cmpny-dt">{{ $order->kode_invoice }}</a>
                                {{-- <span class="job-loca"><i class="fas fa-location-arrow"></i></span> --}}
                                <a href="#" class="oflst125"><i class="fas fa-user-friends me-2"></i>{{ $order->create_time }}</a>
                            </p>
                        </div>
                        <div class="media-btns">
                            <button type="button" class="accpt-btn btn-hover accpt-btn-clr">{{ orderStatus($order->status) }}</button>
                            <button type="button" class="accpt-btn btn-hover accpt-btn-clr">{{ paymentStatus($order->payment_status) }}</button>
                        </div>
                    </div>
                </div>
                @endforeach
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
        $("#table").DataTable();
        // Table
        // $.getJSON(baseUrl + '{{ $url }}/get-data', (result) => {
        //     let html = '';
        //     $.each(result.data, (i, item) => {
        //         html += '<tr>';
        //             html += '<td>'+item.create_time+'</td>';
        //             html += '<td>'+item.kode_invoice+'</td>';
        //             html += '<td>'+item.game_name+'</td>';
        //             html += '<td>'+item.product_name+'</td>';
        //             html += '<td>'+item.harga+'</td>';
        //         html += '</tr>';
        //     });
        //     $("#table").append(html);
        // });
    });  
</script>
@endsection