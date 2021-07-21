@extends('layouts.app')
@section('content')

<div class="container-xl mt-2 py-2">
    <div class="">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-6">
                        <h2><b>Perfil</b></h2>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs" id="tabsInfo" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tabInfo" data-toggle="tab" href="#contentInfo" role="tab" aria-controls="home" aria-selected="true">Información Usuario</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tabContra" data-toggle="tab" href="#contentContra" role="tab" aria-controls="profile" aria-selected="false">Cambiar Contraseña</a>
                </li>
            </ul>
            <div class="tab-content" id="tabsContent">
                <div class="tab-pane fade show active" id="contentInfo" role="tabpanel" aria-labelledby="tabInfo">
                    <div class="alert alert-warning text-center">
                        <i>Para conseguir tu id de telegram envia un mensaje <a href="https://t.me/userinfobot" target="_blank">a este bot</a> y pégalo en el campo correspondiente. Únicamente el usuario permanecerá en el canal si está registrado en este campo.</i>
                    </div>
                    <form method="POST" action="{{ url('perfil/actualizarInfo') }}" >
                        @csrf
                        <div class="form-group row mt-2">
                            <label for="" class="col-md-4 col-form-label text-md-right">Nombre</label>
                            <div class="col-md-6">
                                <input id="nombre" type="text" maxlength="9" class="form-control" name="nombre" value="{{old('nombre', $cliente->nombre)}}" autocomplete="nombre" autofocus>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="" class="col-md-4 col-form-label text-md-right">Dni</label>
                            <div class="col-md-6">
                                <input id="dni" type="text" maxlength="9" class="form-control" name="dni" value="{{old('cliente', $cliente->dni)}}" autocomplete="dni" autofocus>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="" class="col-md-4 col-form-label text-md-right">Telegram ID</label>
                            <div class="input-group col-md-6 mb-3">
                                <input type="text" name="telegram" class="form-control" value="{{old('telegram', $cliente->telegram)}}" required placeholder="123456789">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fab fa-telegram text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="" class="col-md-4 col-form-label text-md-right">Fecha Nacimiento</label>
                            <div class="col-md-6">
                                <input id="fechaNac" type="date" class="form-control" name="fechaNac" value="{{old('fechaNac', $cliente->fechaNac)}}" autocomplete="fechaNac" autofocus>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <label for="" class="col-md-4 col-form-label text-md-right">Dirección</label>
                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{old('direccion', $cliente->direccion)}}" required autocomplete="direccion" autofocus>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 text-right offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="contentContra" role="tabpanel" aria-labelledby="tabContra">
                    <form method="POST" action="{{ url('perfil/actualizarPass') }}">
                        @csrf
                        <div class="form-group row mt-2">
                            <label for="old" class="col-md-4 col-form-label text-md-right">Contraseña anterior</label>

                            <div class="col-md-6">
                                <input id="old" type="password" class="form-control @error('old') is-invalid @enderror" name="old" value="{{ $old ?? old('old') }}" required autocomplete="old" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Resetear Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    
</div>



@endsection