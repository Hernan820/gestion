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
            <div class="col-md-12 text-center">
                <table class="table table-sm border rounded mb-1" style="/*background: white !important;*/">
                    <thead>
                        <tr>
                            <th scope="col">Sin estado</th>
                            <th scope="col">Confirmado</th>
                            <th scope="col">No answer</th>
                            <th scope="col">Cancelados</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
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