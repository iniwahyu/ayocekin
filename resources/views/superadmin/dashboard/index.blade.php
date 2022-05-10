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