@extends( $appSuperadmin )

@section('css-library')
<link href="{{ url('') }}/assets/plugins/datatables/datatables.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.9/sweetalert2.min.js" integrity="sha512-HR+MISLMXOfqEdeVTzt9tsj0xKbyNG+Whhl1BBCNFWERpOXNOaeXTeRilTm3uqRdNiyEFI0EKbcUKvxG82GWmQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('css')
    
@endsection

@section('content')
<div class="row">
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @foreach ($game as $g)
        <div class="col-sm-12 col-xl-6 box-col-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5 class="text-center">{{ $g->nama }}</h5>
                        <a href="{{ url("$url/$g->id") }}"><img src="https://ayocekin.com/upload/game/{{ $g->img }}" class="img-fluid" alt="..."></a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>Total Produk</th>
                                {{-- <th>Selesai</th>
                                <th>Pending</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr class="text-center">
                                <td>33</td>
                                {{-- <td>15</td>
                                <td>18</td> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('js-library')
<script src="{{ url('') }}/assets/plugins/datatables/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.9/sweetalert2.min.css" integrity="sha512-R9EM3xazxo9xyo8pz3IMTw7SIO1qKnG1Vs3yJnVApYhqDwemdSJJbcd5KROicK87kRiFksOhhtW/s2c4Mdjrwg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
<script>
    ///
</script>
@endsection