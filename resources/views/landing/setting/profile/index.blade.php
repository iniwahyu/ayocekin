@extends( $appLanding )

@section('css-library')

@endsection

@section('css')
<style>
    a .card:hover {
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
    }
    .title .card-title {
        color: #000;
    }
</style>
@endsection

@section('content')
<div class="row">
    @include('landing/layouts/sidebar_setting')
    <div class="col-xl-9 col-lg-8 col-md-12">
        <div class="event-card rrmt-30">
            <div class="headtte14m item-setting-top">
                <span class="color_bb"><i class="fas fa-cog"></i></span>
                <h4>Profile</h4>
            </div>
            <form action="{{ url("$url/update/" . $profiles->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="item-setting">
                    <div class="item-padding30 main-form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mt-20">
                                    <label class="label25">Nama</label>
                                    <input type="text" id="iNama" class="form-control" name="nama" value="{{ $profiles->nama }}" autofocus>
                                </div>
                                <div class="form-group mt-20">
                                    <label class="label25">Email</label>
                                    <input type="email" id="iEmail" class="form-control" name="email" placeholder="Email Address Aktif" value="{{ $profiles->email }}">
                                </div>
                                <div class="form-group mt-20">
                                    <label class="label25">No Handphone</label>
                                    <input type="text" id="iPhone" class="form-control" name="phone" placeholder="Nomor Handphone Aktif" value="{{ $profiles->phone }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="save-change-btns">
                        <button type="submit" class="main-save-btn color btn-hover">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="event-card rrmt-30">
            <div class="headtte14m item-setting-top">
                <span class="color_bb"><i class="fas fa-cog"></i></span>
                <h4>Ubah Password</h4>
            </div>
            <form action="{{ url("$url/update-password/" . $profiles->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="item-setting">
                    <div class="item-padding30 main-form">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mt-20">
                                    <label class="label25">Kata Sandi</label>
                                    <input type="password" id="iPassword" class="form-control" name="password" placeholder="********" required>
                                </div>
                                <div class="form-group mt-20">
                                    <label class="label25">Konfirmasi Kata Sandi</label>
                                    <input type="password" id="iPasswordConfirmation" class="form-control" name="password_confirmation" placeholder="********" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="save-change-btns">
                        <button type="submit" class="main-save-btn color btn-hover">Save Changes</button>
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