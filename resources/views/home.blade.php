@extends('layouts.app')

@section('content')
<div class="container">

    <div class="jumbotron jumbotron-fluid rounded border text-center mb-3" style="background: #EBEBEB">
        <div class="container">
            {{-- <h1 class="display-4">Fluid jumbotron</h1> --}}
            <p class="lead mt-3">Gestion de clientes encuentra tu casa</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center  table-responsive">
                <table id="id_tblclientes" class="table table-sm border rounded mb-1" style="/*background: white !important;*/">
                    {{-- <table id="registro_clientes_seminarios"
                    class="table table-sm table-striped table-bordered dt-responsive nowrap datatable display text-center"
                     cellspacing="0" cellpadding="3" width="100%"
                    style="background-color: ;color: black;"> --}}
                    <thead>
                        <tr>
                            <th class="col-md-">#</th>
                            <th class="col-md-">Fechas</th>
                            <th class="col-md-">Nombre Cliente</th>
                            <th class="col-md-">Numero Telefono</th>
                            <th class="col-md-">Estado</th>
                            <th class="col-md-">Comentario</th>
                            <th class="col-md-">Estado resgistro</th>
                            <th class="col-md-"></th>
                            <th class="col-md-"> Opciones&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody scope="row">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection