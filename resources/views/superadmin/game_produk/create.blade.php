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
                                <label>Pilih Game</label>
                                <select name="idGMaster" class="form-control">
                                    <option value="">- Pilih Game -</option>
                                    @foreach ($game as $g)
                                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>  
                            </div>
                            <div class="form-group">
                                <label>Nama Produk Game</label>
                                <input type="text" id="nama" class="form-control" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Produk Game</label>
                                <input type="number" id="harga" class="form-control" name="harga" required>
                            </div>
                            <div class="form-group">
                                <label>Pilih Cara Upload Gambar</label>
                                <select id="select-pilih-gambar" required  class="form-control">
                                    <option value="">- Pilih Cara Upload -</option>
                                    <option value="1">Pilih Sebelumnya</option>
                                    <option value="2">Upload Baru</option>
                                </select>
                                {{-- <select name="idGMaster" class="form-control">
                                    <option value="">- Pilih Gambar -</option>
                                    @foreach ($gambarProduk as $gp)
                                        <option value="{{ $g->url }}"><img src="https://ayocekin.com/upload/game/produk/{{ $gp->url }}" style="width:25px;height:25px;" alt=""></option>
                                    @endforeach
                                </select> --}}
                                
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                        <div class="col-lg-6" id="upload-gambar">
                            <div class="form-group">
                                <label>Upload Gambar Baru</label>
                                <input type="file" class="dropify" name="photo" data-default-file="" />
                            </div>
                        </div>
                        <div class="col-lg-3" id="pilih-gambar">
                            @foreach ($gambarProduk as $gp)
                            <div class="form-group">
                                <div class="card file-manager-recent-item">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <label class="form-check-label" for="gridCheck">
                                                    <img src="https://ayocekin.com/upload/game/produk/{{ $gp->img }}" style="width:50px;height:50px; margin-left: -30px;" alt="">
                                                </label>
                                            </div>
                                            <input class="form-check-input" type="checkbox" id="gridCheck" name="sebelum" style="height: 25px; width: 25px; margin-left: 30px;" value="{{ $gp->img }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
    $('#upload-gambar').hide();
    $('#pilih-gambar').hide();

    $('#select-pilih-gambar').change(function(){
                // alert(this.value)
                if(this.value=="2"){
                    $('#upload-gambar').show();
                    $('#pilih-gambar').hide();
                }else if(this.value=="1"){
                    $('#upload-gambar').hide();
                    $('#pilih-gambar').show();
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