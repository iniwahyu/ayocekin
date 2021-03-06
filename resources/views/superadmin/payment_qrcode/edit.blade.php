@extends( $appSuperadmin )

@section('css-library')
<link href="{{ url('') }}/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a href="{{ url("$url") }}" class="btn btn-primary btn-sm float-end">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ url("$url") }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nama Pembayaran QRCode</label>
                                <input type="text" id="nama" class="form-control" name="nama" value="{{ $qrcode->nama }}" required>
                            </div>
                            <div class="form-group">
                                <label>No. Rekening</label>
                                <input type="number" id="nama" class="form-control" name="rekening" value="{{ $qrcode->rekening }}" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Pemegang Rekening</label>
                                <input type="text" id="nama" class="form-control" name="nama_pemegang" value="{{ $qrcode->nama_pemegang }}" required>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Logo Pembayaran</label>
                                <input type="file" class="dropify" name="photo" required required data-default-file="" />
                            </div>
                            <div class="form-group">
                                <label>Gambar QRCode</label>
                                <input type="file" class="dropify" name="photo2" required required data-default-file="" />
                            </div>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js-library')
<script src="{{ url('') }}/assets/plugins/datatables/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('js')
<script>
    $(function() {
        // Get Role
        $.getJSON(baseUrl + '/master/role', (result) => {
            let opt = '<option value="">Pilih </option>';
        });

        // Photo
        $(".dropify").dropify();
    });
</script>
@endsection