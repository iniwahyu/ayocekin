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
            <form action="{{ url("$url/$banner->id") }}" method="post" enctype="multipart/form-data">
            @method('put')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            {{-- <img class="img-preview img-fluid mb-3 col-sm-5 d-block" src="{{ url("") }}/upload/banner/{{ $banner->img }}"> --}}

                            <div class="form-group">
                                <label>Upload Foto baru (1280 x 350)</label>
                                <input type="file" class="dropify" name="photo" data-default-file="{{ url('upload/banner/' . $banner->img) }}" data-max-file-size="1M"/>
                            </div>
                            <div class="form-group form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="status" {{ $banner->status=='on' ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Tampil di Banner</label>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
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
@endsection

@section('js')
<script>
    $(function() {

        // Photo
        $(".dropify").dropify();
    });
</script>
@endsection