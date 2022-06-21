@extends( $appSuperadmin )

@section('css-library')
<link href="{{ url('') }}/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.9/sweetalert2.min.js" integrity="sha512-HR+MISLMXOfqEdeVTzt9tsj0xKbyNG+Whhl1BBCNFWERpOXNOaeXTeRilTm3uqRdNiyEFI0EKbcUKvxG82GWmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('css')
    
@endsection

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card border-top border-0 border-4 border-info">
            <div class="card-header">
                <h1 class="text-center">Order Top Up</h1>
            </div>
            <div class="text-center" id="wow">
                {{-- <a href="{{ url('') }}/upload/proof/{{ $order->img }}" target="_blank" rel="noopener noreferrer">
                    <img class="thumb" src="{{ url('') }}/upload/proof/{{ $order->img }}" alt="" style="width:50px;height:100px;"  class="img-fluid img-5">
                </a> --}}
                <div class="lightbox-example">
                    <a data-fslightbox="gallery" href="{{ url('') }}/upload/proof/{{ $order->img }}">
                        <img src="{{ url('') }}/upload/proof/{{ $order->img }}">
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="datatable" class="table text-center">
                    <tbody>
                        <tr>
                            <td class="text-sm-end col-sm-6">Kode Invoice</td>
                            <td>:</td>
                            <td class="text-sm-start col-sm-6">{{ $order->kode_invoice }}</td>
                        </tr>
                        <tr>
                            <td class="text-sm-end">Game</td>
                            <td>:</td>
                            <td class="text-sm-start col-sm-6">{{ $order->game->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-sm-end">Produk Game</td>
                            <td>:</td>
                            <td class="text-sm-start col-sm-6">{{ $order->gameProduk->nama }}</td>
                        </tr>
                        <tr>
                            <td class="text-sm-end">Harga Produk</td>
                            <td>:</td>
                            <td class="text-sm-start col-sm-6">{{ $order->gameProduk->harga }}</td>
                        </tr>
                        <tr>
                            <td class="text-sm-end">Total Bayar</td>
                            <td>:</td>
                            <td class="text-sm-start col-sm-6">{{ $order->bayar }}</td>
                        </tr>
                        <tr>
                            <td class="text-sm-end">Username Pembeli</td>
                            <td>:</td>
                            <td class="text-sm-start col-sm-6">{{ $order->user->username }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Keterangan Pembelian</h3>
            </div>
            <div class="card-body">
                <table id="datatable" class="table text-center">
                    <tbody>
                        @if ($qserver==1)
                            <tr>
                                <td class="text-sm-end col-sm-6">User ID</td>
                                <td>:</td>
                                <td class="text-sm-start col-sm-6">{{ $order->akun }}</td>
                            </tr>
                            <tr>
                                <td class="text-sm-end col-sm-6">Server ID</td>
                                <td>:</td>
                                <td class="text-sm-start col-sm-6">{{ $order->server }}</td>
                            </tr>
                        @elseif ($qserver==2)
                            <tr>
                                <td class="text-sm-end col-sm-6">User ID</td>
                                <td>:</td>
                                <td class="text-sm-start col-sm-6">{{ $order->akun }}</td>
                            </tr>
                        @elseif ($qserver==3)
                            <tr>
                                <td class="col-sm-12">Tidak Membutuhkan Informasi Tambahan</td>
                            </tr>
                        @elseif ($qserver==4)
                            <tr>
                                <td class="text-sm-end col-sm-6">Server ID</td>
                                <td>:</td>
                                <td class="text-sm-start col-sm-6">{{ $order->server }}</td>
                            </tr>
                        @elseif ($qserver==5)
                            <tr>
                                <td class="text-sm-end col-sm-6">Kingdom Game</td>
                                <td>:</td>
                                <td class="text-sm-start col-sm-6">{{ $order->kingdom }}</td>
                            </tr>
                            <tr>
                                <td class="text-sm-end col-sm-6">User ID</td>
                                <td>:</td>
                                <td class="text-sm-start col-sm-6">{{ $order->akun }}</td>
                            </tr>
                            <tr>
                                <td class="text-sm-end col-sm-6">Email Game</td>
                                <td>:</td>
                                <td class="text-sm-start col-sm-6">{{ $order->email_game }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="{{ url("$url/$order->kode_invoice") }}" method="post">
    @method('put')
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable" class="table text-center">
                        <tbody>
                        <tr>
                            <td class="text-sm-end col-sm-6">Pembayaran</td>
                            <td>:</td>
                            <td class="text-sm-start col-sm-6">
                                <div class="form-group">
                                    <select name="payment_status" class="form-control">
                                        <option value="">- Status Pembayaran -</option>
                                        @foreach ($paymentStatus as $ps)
                                            @if ($ps->id==$order->payment_status)   
                                                <option value="{{ $ps->id }}" selected>{{ $ps->nama }}</option>
                                            @else
                                                <option value="{{ $ps->id }}">{{ $ps->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>  
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-sm-end">Status Transaksi</td>
                            <td>:</td>
                            <td class="text-sm-start">
                                <div class="form-group">
                                    <select name="status" class="form-control">
                                        <option value="">- Status Transaksi -</option>
                                        @foreach ($orderStatus as $os)
                                            @if ($os->id==$order->status)  
                                                <option value="{{ $os->id }}" selected>{{ $os->nama }}</option>
                                            @else
                                                <option value="{{ $os->id }}">{{ $os->nama }}</option>
                                            @endif
                                        @endforeach
                                    </select>  
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                    <table id="datatable" class="table text-center">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">UPDATE STATUS</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js-library')
    <script src="{{ url('') }}/assets/plugins/datatables/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.9/sweetalert2.min.css" integrity="sha512-R9EM3xazxo9xyo8pz3IMTw7SIO1qKnG1Vs3yJnVApYhqDwemdSJJbcd5KROicK87kRiFksOhhtW/s2c4Mdjrwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="{{ url('') }}/assets/plugins/lightbox/fslightbox.js"></script>
    <script src="{{ url('') }}/assets/js/pages/lightbox.js"></script>
@endsection

@section('js')
<script>
    $(function() {
        $("wow").on("click", function() {
            window.open($("img").attr("src"), "_blank", "menubar=1,resizable=1"); 
        });
        
    });
</script>
@endsection