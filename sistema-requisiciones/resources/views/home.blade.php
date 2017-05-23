@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (auth()->user()->auth == false)
            <div class="panel panel-warning">
                <div class="panel-heading">Advertencia</div>

                <div class="panel-body  text-center">
                    Tu cuenta está en proceso de verificación, una vez sea aprobada, tendrás acceso a las actividades correspondientes 
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
