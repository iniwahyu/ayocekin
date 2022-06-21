@extends( $appLanding )

@section('css-library')

@endsection

@section('css')

@endsection

@section('content')
{{-- <form action="{{ url('verififcation-proses') }}" method="post" id="formSubmit">
    @csrf --}}
    <div class="row justify-content-center">
        <div class="col col-xl-6">
            <div class="full-width mb-30 card">
                <div class="card-body">
                    <div class="form-group">
                        <input type="text" id="iOtp" class="form-control" name="otp" placeholder="Masukkan Kode OTP Disini" onkeypress="return isNumber(event)" autofocus required>
                    </div>
                    <span id="notify" class="py-1"></span>
                    <p class="mb-0 mt-2">Kode Belum Terkirim? Silahkan <a href="javascript:void(0);" id="verification" data-id="{{ $usersId }}"><b>Kirim Ulang</b></a></p>
                </div>
            </div>
        </div>
    </div>
{{-- </form> --}}
@endsection

@section('js-library')

@endsection

@section('js')
<script>
    $(function() {
        
        $("#iOtp").on("keyup", function() {
            if(this.value.length == 6) {
                console.log("Min Max 6");
                let otp = this.value;
                let id = '{{ $usersId }}'
                $.ajax({
                    url: baseUrl + '/verification-proses',
                    type: 'post',
                    dataType: 'json',
                    data: {otp: otp, id: id},
                    success: (result) => {
                        if (result.status == true) {
                            console.log('Kode Sesuai');
                            $(this).prop("readonly", true);
                            $("#notify").html("Kode Sesuai");
                            setTimeout(() => {
                                window.location = baseUrl + '/thanks';
                            }, 1000);
                        } else {
                            console.log('Kode Tidak Sesuai');
                            $("#notify").html("Kode Tidak Sesuai");
                        }
                    },
                    error: (err) => {
                        console.log(err.responseText);
                    }
                })
            }
        });

        $("#verification").on("click", function() {
            let dataId = $(this).data("id");
            // alert(dataId);
            $.ajax({
                url: baseUrl + '/verification-regenerate/' + dataId,
                type: 'GET',
                // dataType: 'json',
                success: (result) => {
                    console.log('regenerate');
                    console.log(result.data);
                },
                error: (err) => {

                }
            });
        });
    })
</script>
@endsection