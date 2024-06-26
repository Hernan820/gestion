@extends('layouts.app')

@section('content')

@if (Route::has('login'))
@if(@Auth::user()->hasRole('administrador'))



<script src="{{ asset('js/usuarios.js') }}" defer></script>

<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form id="frmresgitro_usuarios">
                        {{-- @csrf --}}

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control" required
                                    autocomplete="off" autofocus placeholder="Nombre">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" required
                                    autocomplete="off" placeholder="example@example.com">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                                <select name="rol" id="rol" class="form-control" required autocomplete="off">
                                    <option value="" selected>Roles</option>
                                    <option value="administrador">Administrador</option>
                                    <option value="usuario">Usuario</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3" id="bqcontra" style="display: none;">
                            <label for="name" class="col-md-4 col-form-label text-md-end"></label>

                            <div class="col-md-6 ml-4">
                                <input class="form-check-input" type="checkbox" id="cambiar_contra"
                                    name="cambiar_contra">
                                <label class="form-check-label" for="cambiar_contra">
                                    Cambiar contraseña
                                </label>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="off" placeholder="contraseña">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirma Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="off" placeholder="contraseña">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btnregistrar" type="button" onclick="registro_usuario()"
                                    class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                                <button id="btnnuevo" type="button" onclick="limpiarForm();" class="btn btn-primary"
                                    style="display: none;">
                                    {{ __('Nuevo') }}
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="id_usuario" id="id_usuario">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-9 table-responsive border rounded bg-white">
                <table id="tblusuariosgestion" class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col-3">Nombre</th>
                            <th scope="col-3">Correo</th>
                            <th scope="col-3">Rol</th>
                            <th scope="col-3"></th>
                        </tr>
                    </thead>
                    <tbody id="insertarUsusarios" scope="row">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@else
<h2>No tienes permisos para ver esta pagina.</h2>
@endif
@endif

@endsection