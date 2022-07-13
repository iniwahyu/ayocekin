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
                    <div id="timer" class="mt-3">
                        <p><span id="myTimer">0</span></p>
                    </div>
                    <div id="verif">
                        <p class="mb-0 mt-2">Kode Belum Terkirim? </p>
                        <button id="verification" class="btn background-color-primary text-white" data-id="{{ $usersId }}" aria-disabled="true"><b>Kirim Ulang</b></button>
                    </div>
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

        // Timer Hide
        $("#timer").hide();

        // Verification Click
        $("#verification").on("click", function() {
            let dataId = $(this).data("id");
            $("#verification").prop("disabled", true);
            $.ajax({
                url: baseUrl + '/verification-regenerate/' + dataId,
                type: 'GET',
                // dataType: 'json',
                success: (result) => {
                    console.log('regenerate');
                    console.log(result.data);
                    // Hide Button
                    if (result.status == true) {
                        $("#verif").hide();
                        // CountDown
                        countDown(60*1, $("#timer").show())
                    }
                },
                error: (err) => {
                    
                }
            });
        });
        // countDown();
    })

    function countDown(duration, display, after) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text("Bisa Kirim Ulang Dalam " + minutes + ":" + seconds);

            // timer--;
            if (--timer < 0) {
                // timer = duration;
                timer = duration;
                $("#timer").hide();
                $("#verif").show();
                console.log("Dalam IF:" + timer);
                clearInterval(this);
                location.reload();
                return;
            }
            // console.log(timer);
        }, 1000);
    }
</script>
@endsection