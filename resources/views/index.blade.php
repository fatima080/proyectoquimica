@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col-12">
        <div>
            <h2 class="text-black">Stock de químicos</h2>
        </div>
        <div class="d-flex align-items-center">
            @php
                $user = Auth::user();
                $role = 'Guest';

                if ($user) {
                    $firstRole = $user->roles->first();
                    if ($firstRole) {
                        $role = $firstRole->name;
                    }
                }
                $groupIndex = 0;
            @endphp

            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('productos.create') }}" class="btn btn-verde ml-2" style="{{ $role === 'Admin' ? '' : 'visibility: hidden;' }}">Dar de alta un químico</a>
                    <a href="{{ route('productos.historial') }}" class="btn btn-verde ml-2" style="{{ $role === 'Admin' ? '' : 'visibility: hidden;' }}">Ver historial de movimientos</a>
                </div>
                <form action="{{ route('productos.index') }}" method="GET" class="d-inline-flex" style="margin-left: 400px;">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre, CAS o tipo">
                    <button type="submit" class="btn btn-verde" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @if(Session::get('verde'))
    <div class="alert alert-verde mt-2">
        <strong>{{ Session::get('verde') }}</strong>
    </div>
    @endif

    <div class="col-12 mt-4">
        <table class="table table-bordered text-black">
            <tr class="text-secondary">
                <th>Nombre</th>
                <th>CAS</th>
                <th>FDS</th>
                <th>Tipo</th>
            </tr>
            @php
            $groupedProducts = $casProductos->groupBy(function ($item, $key) {
                return $item['nombre_cas_producto'].$item['cas'].$item['fds'].$item['tipo'];
            });
            @endphp
            @foreach($groupedProducts as $group)
                @php
                $firstItem = $group->first();
                $sortedGroup = $group->sortBy('caducidad');
                @endphp
                <tr>
                    <td class="fw-bold">{{ $firstItem->nombre_cas_producto }}</td>
                    <td>{{ $firstItem->cas }}</td>
                    <td>
                        @if($firstItem->fds)
                            <a href="{{ $firstItem->fds }}" style="color:green" target="_blank">
                                <i class="fas fa-eye"></i>
                            </a>
                        @endif
                    </td>
                    <td>{{ $firstItem->tipo }}</td>
                    <td>
                        <button class="btn btn-link toggle-button" style="color:green" type="button" data-bs-toggle="collapse" data-bs-target="#producto{{ $groupIndex }}" aria-expanded="false" aria-controls="producto{{ $groupIndex }}">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="collapse" id="producto{{ $groupIndex }}">
                            <div class="card card-body">
                                <table class="table">
                                    <tr>
                                        <th>Concentración</th>
                                        <th>Caducidad</th>
                                        <th>Capacidad</th>
                                        <th>Armario</th>
                                        <th>Balda</th>
                                        <th>Hp</th>
                                        <th>Descripción Hp</th>
                                        @if ($role === 'Admin')
                                            <th>Acciones</th>
                                        @endif
                                    </tr>
                                    @foreach($sortedGroup as $casProducto)
                                    <tr>
                                        <td>
                                            {{ $casProducto->concentracion ?? '' }}
                                            @if($casProducto->concentracion)
                                                {{ $casProducto->tipo_concentracion ?? '' }}
                                            @endif
                                        </td>
                                        <td>{{ $casProducto->caducidad ?? '' }}</td>
                                        <td id="capacidad-{{ $casProducto->id_producto }}" class="capacidad">{{ $casProducto->capacidad ?? '0' }} {{ $casProducto->estado == 'liquido' ? 'ml' : 'gr' }}</td>
                                        <td>{{ $casProducto->armario ?? '' }}</td>
                                        <td>{{ $casProducto->balda ?? '' }}</td>
                                        <td>{{ $casProducto->h_producto ?? '' }}</td>
                                        <td>{{ $casProducto->desc ?? '' }}</td>
                                        <td id="consumo-{{ $casProducto->id_producto }}" class="consumo">
                                            <div class="form-group">
                                                <strong>Cantidad consumida:</strong>
                                                <input type="text" name="cantidad" class="form-control" placeholder="Cantidad" required>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($role === 'Admin')
                                                <a href="{{ route('productos.edit', $casProducto->id_producto) }}" class="btn btn-success">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button id="editar-{{ $casProducto->id_producto }}" class="btn btn-primary editar-cantidad" data-id="{{ $casProducto->id_producto }}">
                                                    Editar cantidad
                                                </button>
                                                <form action="{{ route('productos.destroy', $casProducto->id_producto) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        @php
                            $groupIndex++;
                        @endphp
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
