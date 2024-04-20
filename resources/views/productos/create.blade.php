@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Dar de alta un químico</h2>
        </div>
        <div>
            <a href="{{route('productos.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mt-2">
            <strong>Error !</strong> en el formulario..<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{route('productos.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre_cas_producto" class="form-control" placeholder="Nombre" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>CAS:</strong>
                    <input type="text" name="cas" class="form-control" placeholder="CAS" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>FDS:</strong>
                    <input type="text" name="fds" class="form-control" placeholder="FDS" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Tipo:</strong>
                    <select name="tipo" class="form-control">
                        @foreach ($enum as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group row">
                    <div class="col-md-6">
                        <strong>Concentración:</strong>
                        <input type="text" name="concentracion" class="form-control" placeholder="Concentración">
                    </div>
                    <div class="col-md-6">
                        <strong>Tipo Concentracion:</strong>
                        <select name="tipo_concentracion" class="form-control">
                            @foreach ($enumConcentracion as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Caducidad:</strong>
                    <input type="date" name="caducidad" class="form-control" placeholder="Caducidad">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group row">
                    <div class="col-md-6">
                        <strong>Capacidad:</strong>
                        <input type="text" name="capacidad" class="form-control" placeholder="Capacidad">
                    </div>
                    <div class="col-md-6">
                        <strong>Estado:</strong>
                        <select name="estado" class="form-control">
                            @foreach ($enumEstado as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Armario:</strong>
                    <input type="text" name="armario" class="form-control" placeholder="Armario" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Balda:</strong>
                    <input type="text" name="balda" class="form-control" placeholder="Balda" >
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>HP:</strong>
                    <select name="h_producto[]" class="form-control" multiple>
                        @foreach ($h_desc as $h)
                            <option value="{{ $h->h }}">{{ $h->h }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Cantidad:</strong>
                    <input type="text" name="cantidad" class="form-control" placeholder="Cantidad">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Movimiento:</strong>
                    <select name="movimiento" class="form-control">
                        @foreach ($enumMovimiento as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Motivo:</strong>
                    <select name="motivo" class="form-control">
                        @foreach ($enumMotivo as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </div>
    </form>
</div>
@endsection
