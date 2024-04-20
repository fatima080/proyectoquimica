@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2>Historial</h2>
        </div>
        <div>
            <a href="{{route('productos.index')}}" class="btn btn-primary">Volver</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Movimiento</th>
                    <th>Cantidad</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($historiales as $historial)
                    @if($historial->producto)
                        <tr>
                            <td>{{ $historial->user->name }}</td>
                            <td>{{ $historial->producto->nombre_cas_producto }}</td>
                            <td>{{ $historial->fecha }}</td>
                            <td>{{ $historial->movimiento }}</td>
                            <td>{{ $historial->cantidad }}</td>
                            <td>{{ $historial->motivo }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
