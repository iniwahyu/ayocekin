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
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title">{{ $title ?? '-' }}</h5>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{ url("$url/create") }}" class="btn btn-primary btn-sm float-end">Tambah Produk</a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable1" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Nama Bank</th>
                            <th>Kode</th>
                            <th>No. Rekening</th>
                            <th>Pemegang Rekening</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($manual as $m)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="https://ayocekin.com/upload/bank/{{ $m->img }}" style="width:25px;height:25px;" alt=""></td>
                                <td>{{ $m->nama }}</td>
                                <td>{{ $m->kode }}</td>
                                <td>{{ $m->rekening }}</td>
                                <td>{{ $m->nama_pemegang }}</td>
                                <td>Aksi</td>
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
    
</script>
@endsection