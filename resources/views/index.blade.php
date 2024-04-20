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

            @if ($role === 'Admin')
                <a href="{{ route('productos.create') }}" class="btn btn-primary ml-2">Dar de alta un químico</a>
                <a href="{{ route('productos.historial') }}" class="btn btn-primary ml-2">Ver historial de movimientos</a>
            @endif
            <form action="{{ route('productos.index') }}" method="GET" class="d-inline-flex">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre, CAS o tipo">
                <button type="submit" class="btn btn-primary" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    @if(Session::get('success'))
    <div class="alert alert-success mt-2">
        <strong>{{ Session::get('success') }}</strong>
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
                            <a href="{{ $firstItem->fds }}" class="badge bg-warning fs-6" target="_blank">Ver</a>
                        @endif
                    </td>
                    <td>{{ $firstItem->tipo }}</td>
                    <td>
                        <button class="btn btn-link toggle-button" type="button" data-bs-toggle="collapse" data-bs-target="#producto{{ $groupIndex }}" aria-expanded="false" aria-controls="producto{{ $groupIndex }}">
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
                                        <td>{{ $casProducto->capacidad ?? '0' }} {{ $casProducto->estado == 'liquido' ? 'ml' : 'gr' }}</td>
                                        <td>{{ $casProducto->armario ?? '' }}</td>
                                        <td>{{ $casProducto->balda ?? '' }}</td>
                                        <td>{{ $casProducto->h_producto ?? '' }}</td>
                                        <td>{{ $casProducto->desc ?? '' }}</td>
                                        <td>
                                            @if ($role === 'Admin')
                                                <a href="{{ route('productos.edit', $casProducto->id_producto) }}" class="btn btn-primary">Editar</a>
                                                <form action="{{ route('productos.destroy', $casProducto->id_producto) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
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
