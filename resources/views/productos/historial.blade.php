<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historial de movimientos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @include('layouts.base', ['some' => 'data'])
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <h2>Historial</h2>
                            </div>
                            <div>
                                <a href="{{route('dashboard')}}" class="btn btn-verde">Volver</a>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
