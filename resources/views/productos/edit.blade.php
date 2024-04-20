@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Editar Producto</h2>
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
    <form action="{{route('productos.update',$producto->id_producto)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group row">
                    <div class="col-md-6">
                        <strong>Concentración:</strong>
                        <input type="text" name="concentracion" class="form-control" placeholder="Concentración"  value="{{ $producto->concentracion }}">
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
                    <input type="date" name="caducidad" class="form-control" placeholder="Caducidad"  value="{{ $producto->caducidad }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group row">
                    <div class="col-md-6">
                        <strong>Capacidad:</strong>
                        <input type="text" name="capacidad" class="form-control" placeholder="Capacidad"  value="{{ $producto->capacidad }}">
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
                    <input type="text" name="armario" class="form-control" placeholder="Armario"  value="{{ $producto->armario }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Balda:</strong>
                    <input type="text" name="balda" class="form-control" placeholder="Balda"  value="{{ $producto->balda }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>HP:</strong>
                    <select name="h_producto[]" multiple>
                        @foreach($h_desc as $h)
                            <option value="{{ $h->h }}" {{ in_array($h->h, $h_productos_actuales) ? 'selected' : '' }}>
                                {{ $h->h }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Cantidad:</strong>
                    <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" >
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
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection
