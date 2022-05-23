@extends( $appLanding )

@section('css-library')

@endsection

@section('css')

@endsection

@section('content')
<div class="row">
    @include('landing/layouts/sidebar_setting')
    <div class="col-xl-9 col-lg-8 col-md-12">
        <div class="event-card rrmt-30">
            <div class="headtte14m item-setting-top">
                <span class="color_bb"><i class="fas fa-cog"></i></span>
                <h4>History</h4>
            </div>
            <div class="item-setting">
                <div class="main-table mt-30">
                    <div class="table-responsive">
                        <table class="table">
                            <thead id="table" class="thead-dark">
                                <tr>
                                    <th scope="col">Tanggal Transaksi</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Game</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
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
        // Table
        $.getJSON(baseUrl + '{{ $url }}/get-data', (result) => {
            let html = '';
            $.each(result.data, (i, item) => {
                html += '<tr>';
                    html += '<td>'+item.create_time+'</td>';
                    html += '<td>'+item.kode_invoice+'</td>';
                    html += '<td>'+item.game_name+'</td>';
                    html += '<td>'+item.product_name+'</td>';
                    html += '<td>'+item.harga+'</td>';
                html += '</tr>';
            });
            $("#table").append(html);
        });
    });  
</script>
@endsection