@extends( $appSuperadmin )

@section('css-library')
<link href="{{ url('') }}/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
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
                        <a href="{{ url("$url/$userId/edit") }}" class="btn btn-info btn-sm me-2 float-end">Ubah Data</a>
                    </div>
                </div>
            </div>
            <form action="{{ url("$url/$userId") }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" id="iNama" class="form-control" name="nama" value="{{ $roles->nama }}" required>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js-library')
<script src="{{ url('') }}/assets/plugins/datatables/datatables.min.js"></script>
@endsection

@section('js')
<script>
    $(function() {
        // Photo
        $(".dropify").dropify();
    });
</script>
@endsection