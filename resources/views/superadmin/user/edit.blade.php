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
                        <a href="{{ url("$url/$userId") }}" class="btn btn-primary btn-sm float-end">Kembali</a>
                    </div>
                </div>
            </div>
            <form action="{{ url("$url/$userId") }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="iUsername" class="form-control" value="{{ $users->username }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="iPassword" class="form-control" name="password">
                                <small>Jika tidak ingin mengubah password, harap dikosongkan</small>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select id="selectRole" class="form-control" name="idURole">
                                    <option value="1">Super Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select id="selectStatus" class="form-control" name="status">
                                    <option value="1" {{ $users->status == '1' ? 'selected' : '' }} >Aktif</option>
                                    <option value="0" {{ $users->status == '0' ? 'selected' : '' }} >Tidak Aktif</option>
                                    <option value="2" {{ $users->status == '2' ? 'selected' : '' }} >Diblokir</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="file" class="dropify" name="photo" data-default-file="{{ url('upload/user/' . $users->photo) }}" />
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