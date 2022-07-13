@extends( $appSuperadmin )

@section('css-library')
<link href="{{ url('') }}/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="{{ url('') }}/assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet">
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
                                <label>Nama Game</label>
                                <input type="text" id="nama" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Game</label>
                                <textarea name="deskripsi" class="form-control" cols="30" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Opsi Pengisian</label>
                                <select name="qserver" class="form-control" required>
                                    <option value="">- Pilih Opsi Pengisian -</option>
                                    @foreach ($qserver as $qs)
                                        <option value="{{ $qs->id }}">{{ $qs->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Sistem Pembayaran</label>
                                <select id="pilih-bundle" name="jGame" class="form-control" required>
                                    <option value="">- Pilih Opsi -</option>
                                    @foreach ($jGame as $jg)
                                        <option value="{{ $jg->id }}">{{ $jg->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="input-jmlBundle">
                                <label>Jumlah Bundle</label>
                                <input name="jmlBundle" class="form-control" type="number" placeholder="Input Jumlah Bundle">
                            </div>
                            <div class="form-group" id="pilih-waktuClose">
                                <label>Batas Akhir Tanggal Jual</label>
                                <input name="waktuClose" class="form-control flatpickr1" type="text" placeholder="Pilh Tanggal">
                            </div>
                            <div class="form-group" id="pilih-jamReset">
                                <label>Waktu Reset Jam Harian</label>
                                <input name="jamReset" class="form-control" type="time" placeholder="Pilh Waktu">
                            </div>
                            <div class="form-group" id="pilih-jamOpen">
                                <label>Waktu Buka Jam Penjualan</label>
                                <input name="jamOpen" class="form-control" type="time" placeholder="Pilh Waktu">
                            </div>
                            <div class="form-group" id="pilih-jamClose">
                                <label>Waktu Tutup Jam Penjualan</label>
                                <input name="jamClose" class="form-control" type="time" placeholder="Pilh Waktu">
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Foto Game</label>
                                <input type="file" class="dropify" name="photo" data-default-file="" required/>
                            </div>
                            <div class="form-group">
                                <label>Foto Panduan Game</label>
                                <input type="file" class="dropify" name="photo1" data-default-file="" required/>
                            </div>
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
<script src="{{ url('') }}/assets/plugins/flatpickr/flatpickr.js"></script>
@endsection

@section('js')
<script>
    $(".flatpickr1").flatpickr();


    $('#input-jmlBundle').hide();
    $('#pilih-waktuClose').hide();
    $('#pilih-jamReset').hide();
    $('#pilih-jamOpen').hide();
    $('#pilih-jamClose').hide();

    $('#pilih-bundle').change(function(){
        // alert(this.value)
        if(this.value=="2"){
            $('#input-jmlBundle').show();
            $('#pilih-waktuClose').show();
            $('#pilih-jamReset').show();
            $('#pilih-jamOpen').show();
            $('#pilih-jamClose').show();
        }else if(this.value=="1"){
            $('#input-jmlBundle').hide();
            $('#pilih-waktuClose').hide();
            $('#pilih-jamReset').hide();
            $('#pilih-jamOpen').hide();
            $('#pilih-jamClose').hide();
        }
    });

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