@extends( $appSuperadmin )

@section('css-library')
<link href="{{ url('') }}/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.9/sweetalert2.min.js" integrity="sha512-HR+MISLMXOfqEdeVTzt9tsj0xKbyNG+Whhl1BBCNFWERpOXNOaeXTeRilTm3uqRdNiyEFI0EKbcUKvxG82GWmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            {{-- <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">{{ $title ?? '-' }}</h5>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ url("$url/create") }}" class="btn btn-primary btn-sm float-end">Tambah Produk</a>
                    </div>
                </div>
            </div> --}}
            <div class="card-body table-responsive">
                <table id="datatable1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu Transaksi</th>
                            <th>Username Pembeli</th>
                            <th>kode Invoice</th>
                            <th>Status Pembayaran</th>
                            <th>Status Transaksi</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderInvoice as $oi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $oi->create_time }}</td>
                                <td>{{ $oi->pembeli->username }}</td>
                                <td>{{ $oi->kode_invoice }}</td>
                                <td>{{ $oi->paymentStatus->nama }}</td>
                                <td>{{ $oi->statusTransaksi->nama }}</td>
                                <td>
                                    @if ($oi->status==4 || $oi->status==5)
                                        {{-- <span>btn btn-outline-light txt-dark btn-lg</span> --}}
                                        <div class="btn btn-outline-primary disabled btn-md">
                                            <span>SELESAI</span>
                                        </div>
                                    @else
                                        <div class="btn-group btn-group-square" role="group" aria-label="">
                                            <a href="{{ url("$url/" . $oi->kode_invoice, []) }}/edit" class="btn btn-primary" title="Beri Respon">RESPON</a>
                                            {{-- <a href="javascript:void(0);" class="btn btn-danger" title="Hapus Data">Hapus</a> --}}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-library')
<script src="{{ url('') }}/assets/plugins/datatables/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.9/sweetalert2.min.css" integrity="sha512-R9EM3xazxo9xyo8pz3IMTw7SIO1qKnG1Vs3yJnVApYhqDwemdSJJbcd5KROicK87kRiFksOhhtW/s2c4Mdjrwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
<script>
    $(function() {
        $('#datatable1').DataTable();
        // Datatable
        // $("#datatable1").DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: {
        //         url: "{{ url("$url/get-data") }}",
        //         // data: function (d) {
        //         //     d.search = $("#iSearch").val() ?? null;
        //         // }
        //     },
        //     columns: [
        //         {
        //             data: 'DT_RowIndex', 
        //             name: 'DT_RowIndex',
        //             orderable: false,
        //             searchable: false,
        //             defaultContent: "",
        //         },
        //         {data: 'img', name: 'img'},
        //         {data: 'nama', name: 'nama'},
        //         {data: 'deskripsi', name: 'deskripsi'},
        //         {data: 'actions', name: 'actions', orderable: false, searchable: false},
        //     ]
        // });

        // Delete
        $("#datatable1").on("click", ".delete", function() {
            let dataId = $(this).data("id");
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data yang Sudah Terhapus, Tidak Bisa Kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus Sekarang!',
                cancelButtonText: "Batal!",
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ url("$url") }}/" + dataId,
                        success: (result) => {
                            Swal.fire({
                                title: "Berhasil!",
                                text: ""+result.message+"",
                                icon: "success",
                            })
                            setTimeout(() => {
                                window.location.href = baseUrl + '{{ $url }}';
                            }, 1000);
                        }
                    })
                }
            });
        });
    });
</script>
@endsection