@extends('layouts.app')

@section('content')

<style>
    .container {
        max-width: 1300px !important;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    @if(@Auth::user()->hasRole('administrador'))
    <input type="hidden" name="rol" id="rol" value="administrador" />
    @elseif (@Auth::user()->hasRole('usuario'))
    <input type="hidden" name="rol" id="rol" value="usuario" />
    @endif

<script src="{{ asset('js/manager_clientes.js') }}" defer></script>

<div class="container">

    <div class="jumbotron jumbotron-fluid rounded border text-center mb-3 p-0" style="background: #ffffff">
        <div class="container">
            <p class="lead mt-3 font-weight-bold">Gestion de clientes encuentra tu casa</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <table class="table table-sm border rounded mb-1" style="background: white !important;">
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
                    <tr id="contador_gestion">
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-3 bg-white border rounded">
        <div class="row ">
            <div class="col-md-12 table-responsive">
                <table id="id_tblclientes" class="table table-sm border rounded mb-1 text-center" style="width:1150px !important">
                    <thead>
                        <tr>
                            <th class="col-md-">#</th>
                            <th class="col-md-">Fechas</th>
                            <th class="col-md-">Nombre Cliente</th>
                            <th class="col-md-">Numero Telefono ES</th>
                            <th class="col-md-">Numero Telefono US</th>
                            <th class="col-md-">País</th>
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

</div>

<!-- Modal Notas-->
<div class="modal fade" id="modal_seguimiento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Agregar Seguimiento
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="frmseguimiento">

                    {!! csrf_field() !!}
                    <div class="form-group ">
                        <label for="start">Seguimiento:</label>
                        <textarea name="txtseguimiento" rows="2" required="" id="txtseguimiento" class="form-control"
                            cols="50"></textarea>
                    </div>
                    <input type="hidden" name="registropre_id" id="registropre_id" value="" />

                    <button type="button" class="btn btn-success" id="btnseguimiento">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
            <div class="modal-footer">
                <div class="table-responsive">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col-3">Usuario</th>
                                    <th scope="col-3">Fecha Hora NY</th>
                                    <th scope="col-6">Seguimiento</th>
                                </tr>
                            </thead>
                            <tbody id="tblseguimientos" scope="row">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal   bitacoras -->
<div class="modal fade" id="modal_bitacora_fmr" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    BITACORAS
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="idbitacora">

                    {!! csrf_field() !!}
                    <div class="table-responsive">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Usuario</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora NY</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_bitacora" scope="row">
                                </tbody>
                            </table>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@endsection