@extends( $appSuperadmin )

@section('css-library')

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
                </div>
            </div>
            <form action="{{ url("$url/$profiles->id") }}" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ $profiles->nama ?? null }}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email Aktif" value="{{ $profiles->email ?? null }}">
                    </div>
                    <div class="form-group">
                        <label>Nomor Ponsel</label>
                        <input type="text" class="form-control" name="phone" placeholder="Nomor Ponsel Aktif" value="{{ $profiles->phone ?? null }}">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea id="" cols="30" rows="3" class="form-control" name="address">{{ $profiles->address ?? null }}</textarea>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js-library')

@endsection

@section('js')
<script>
    
</script>
@endsection