<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Añadir químico') }}
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
                                <h2>Dar de alta un químico</h2>
                            </div>
                            <div>
                                <a href="{{route('dashboard')}}" class="btn btn-verde">Volver</a>
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
                                        <input type="text" name="nombre_cas_producto" class="form-control" placeholder="Nombre" required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                    <div class="form-group">
                                        <strong>CAS:</strong>
                                        <input type="text" name="cas" class="form-control" placeholder="CAS" required>
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
                                            <input type="text" name="capacidad" class="form-control" placeholder="Capacidad" required>
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
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                                    <button type="submit" class="btn btn-verde">Crear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
