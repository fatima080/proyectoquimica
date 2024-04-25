<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Producto;
use App\Models\CasProducto;
use App\Models\VistaCasProducto;
use App\Models\HProducto;
use App\Models\H;
use App\Models\Historial;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $casProductos = VistaCasProducto::when($search, function ($query, $search) {
            return $query->where('nombre_cas_producto', 'like', "%{$search}%")
                        ->orWhere('cas', 'like', "%{$search}%")
                        ->orWhere('tipo', 'like', "%{$search}%");
        })->get();

        return view('index', compact('casProductos'));


    }

    public function create(): View //client
    {
        $types = DB::select("SHOW COLUMNS FROM cas_productos WHERE Field = 'tipo'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $types, $matches);
        $enum = array();
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enum[$v] = $v;
        }

        $typesConcentracion = DB::select("SHOW COLUMNS FROM productos WHERE Field = 'tipo_concentracion'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $typesConcentracion, $matchesConcentracion);
        $enumConcentracion = array();
        foreach( explode(',', $matchesConcentracion[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enumConcentracion[$v] = $v;
        }

        $typesEstado = DB::select("SHOW COLUMNS FROM cas_productos WHERE Field = 'estado'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $typesEstado, $matchesEstado);
        $enumEstado = array();
        foreach( explode(',', $matchesEstado[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enumEstado[$v] = $v;
        }

        $typesMotivo = DB::select("SHOW COLUMNS FROM historial WHERE Field = 'motivo'")[0]->Type;

        preg_match('/^enum\((.*)\)$/', $typesMotivo, $matchesMotivo);

        $enumMotivo = array();

        foreach( explode(',', $matchesMotivo[1]) as $value )

        {

            $v = trim( $value, "'" );

            $enumMotivo[$v] = $v;

        }


        $typesMovimiento = DB::select("SHOW COLUMNS FROM historial WHERE Field = 'movimiento'")[0]->Type;

        preg_match('/^enum\((.*)\)$/', $typesMovimiento, $matchesMovimiento);

        $enumMovimiento = array();

        foreach( explode(',', $matchesMovimiento[1]) as $value )

        {

            $v = trim( $value, "'" );

            $enumMovimiento[$v] = $v;

        }

        $h_desc = H::all();

        return view('productos.create', compact('enum', 'enumConcentracion', 'enumEstado', 'enumMovimiento', 'enumMotivo','h_desc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse /*server */
    {

        $casProducto = new CasProducto;
        $casProducto->id = rand(1000, 9999);
        $casProducto->cas = $request->input('cas');
        $casProducto->nombre = $request->input('nombre_cas_producto');
        $casProducto->fds = $request->input('fds');
        $casProducto->estado = $request->input('estado');
        $casProducto->tipo = $request->input('tipo');
        $casProducto->save();


        // Primero, crea un nuevo producto
        $producto = new Producto;
        $producto->id_producto = rand(1000, 9999); // genera un número aleatorio entre 1000 y 9999
        $producto->id_cas = $casProducto->id;
        $producto->concentracion = $request->input('concentracion');
        $producto->tipo_concentracion = $request->input('tipo_concentracion');
        $producto->caducidad = $request->input('caducidad');
        $producto->capacidad = $request->input('capacidad');
        $producto->armario = $request->input('armario');
        $producto->balda = $request->input('balda');
        $producto->fecha_entrada = $request->input('caducidad');
        $producto->save();

        if ($request->h_producto) {
            // Itera sobre cada elemento en 'h_producto'
            foreach ($request->h_producto as $h_producto) {
                // Crea un nuevo registro en la tabla 'h_productos' para cada elemento
                $hProducto = new HProducto;
                $hProducto->id_producto = $producto->id_producto;
                $hProducto->h = $h_producto;
                $hProducto->save();
            }
        }


        $historial = new Historial;
        $historial->usuario = auth()->user()->id;
        $historial->id_producto = $producto->id_producto;
        $historial->fecha = now();
        $historial->cantidad = $request->input('capacidad');
        $historial->movimiento = 'entrada';
        $historial->motivo = 'adquisicion';

        $historial->save();

        return redirect()->route('dashboard')->with('success', 'Nuevo producto creado exitosamente!');
    }

    /*
    Mustra el historial
    */
    public function show()
    {
        $historiales = Historial::with(['user', 'producto'])->get();
        return view('productos.historial', compact('historiales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_producto)
    {
        $producto = Producto::find($id_producto);

        if (!$producto) {
            // Si no se encuentra el producto, redirige al usuario a una página de error o a otra página.
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado!');
        }

        $typesConcentracion = DB::select("SHOW COLUMNS FROM productos WHERE Field = 'tipo_concentracion'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $typesConcentracion, $matchesConcentracion);
        $enumConcentracion = array();
        foreach( explode(',', $matchesConcentracion[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enumConcentracion[$v] = $v;
        }

        $typesEstado = DB::select("SHOW COLUMNS FROM cas_productos WHERE Field = 'estado'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $typesEstado, $matchesEstado);
        $enumEstado = array();
        foreach( explode(',', $matchesEstado[1]) as $value )
        {
            $v = trim( $value, "'" );
            $enumEstado[$v] = $v;
        }

        $typesMotivo = DB::select("SHOW COLUMNS FROM historial WHERE Field = 'motivo'")[0]->Type;

        preg_match('/^enum\((.*)\)$/', $typesMotivo, $matchesMotivo);

        $enumMotivo = array();

        foreach( explode(',', $matchesMotivo[1]) as $value )

        {

            $v = trim( $value, "'" );

            $enumMotivo[$v] = $v;

        }


        $typesMovimiento = DB::select("SHOW COLUMNS FROM historial WHERE Field = 'movimiento'")[0]->Type;

        preg_match('/^enum\((.*)\)$/', $typesMovimiento, $matchesMovimiento);

        $enumMovimiento = array();

        foreach( explode(',', $matchesMovimiento[1]) as $value )

        {

            $v = trim( $value, "'" );

            $enumMovimiento[$v] = $v;

        }

        $h_desc = H::all();
        // Obtén los valores actuales de h_producto para este producto
        $h_productos_actuales = HProducto::where('id_producto', $id_producto)->pluck('h')->toArray();
        // ...
        return view('productos.edit', compact('producto', 'enumConcentracion', 'enumEstado', 'enumMovimiento', 'enumMotivo', 'h_desc', 'h_productos_actuales'));
    }

    public function update(Request $request, $id_producto)
    {
        $request->validate([
            'concentracion' ,
            'tipo_concentracion' ,
            'caducidad' ,
            'capacidad' ,
            'estado' ,
            'armario' ,
            'balda' ,
            'h_producto' => 'array',
        ]);

        $producto = Producto::find($id_producto);
        $updateData = $request->all();

        if ($request->has('cantidad')) {
            $producto->capacidad -= $request->input('cantidad');
            $producto->save();
        }

        unset($updateData['capacidad']);

        if ($request->h_producto) {
            // Si h_producto es un array, lo convertimos a un string para poder almacenarlo en la base de datos
            if (is_array($updateData['h_producto'])) {
                $updateData['h_producto'] = implode(',', $updateData['h_producto']);
            }

            // Elimina los valores actuales de h_producto para este producto
            HProducto::where('id_producto', $id_producto)->delete();

            // Inserta los nuevos valores de h_producto
            foreach ($request->h_producto as $h_producto) {
                $hProducto = new HProducto;
                $hProducto->id_producto = $id_producto;
                $hProducto->h = $h_producto;
                $hProducto->save();
            }
        }

        $producto->update($updateData);

        $historial = new Historial;
        $historial->usuario = auth()->user()->id;
        $historial->id_producto = $producto->id_producto;
        $historial->fecha = now();
        $historial->cantidad = $request->input('cantidad');
        $historial->movimiento = 'salida';
        if($request->has('motivo')){
            $historial->motivo = $request->input('motivo');
        } else {
            $historial->motivo = 'consumo';
        }

        $historial->save();

        if ($request->ajax()) {
            // Si es una llamada AJAX, devuelve una respuesta JSON con la capacidad
            return response()->json(['capacidad' => $producto->capacidad], 200);
        } else {
            // Si no es una llamada AJAX, redirige al usuario como antes
            return redirect()->route('dashboard')->with('success', 'Producto actualizado exitosamente!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id_producto): RedirectResponse
    {
        // Encuentra el producto en la tabla 'productos'
        $producto = Producto::find($id_producto);

        if ($producto) {
            // Crea un nuevo registro en la tabla historial
            // para registrar que se va a eliminar un producto
            $historial = new Historial;
            $historial->usuario = auth()->user()->id;
            $historial->id_producto = $producto->id_producto;
            $historial->fecha = now();
            $historial->cantidad = $producto->capacidad;
            $historial->movimiento = 'salida';
            $historial->motivo = 'otro';
            $historial->save();

            // Encuentra el registro correspondiente en la tabla 'cas_productos'
            $casProducto = CasProducto::find($producto->id_cas);

            if ($casProducto) {
                // Elimina el producto
                Producto::destroy($producto->id_producto);

                // Ahora que el producto ha sido eliminado, puedes eliminar el registro de 'cas_productos'
                $casProducto->delete();
            }
        }

        return redirect()->route('dashboard')->with('success', 'Producto eliminado y registrado en el historial exitosamente!');
    }
}
