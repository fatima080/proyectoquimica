<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Models\VistaCasProducto;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/productos/{id_producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id_producto}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id_producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
Route::get('/productos/historial', [ProductoController::class, 'show'])->name('productos.historial');

Route::get('/', function () {
    $casProductos = VistaCasProducto::select('id_producto', 'nombre_cas_producto', 'cas', 'fds', 'tipo', 'caducidad', 'concentracion', 'tipo_concentracion', 'capacidad', 'estado', 'armario', 'balda', 'h_producto', 'desc')->get();
    return view('welcome', ['casProductos' => $casProductos]);
});

Route::get('/dashboard', function () {
    $casProductos = VistaCasProducto::select('id_producto', 'nombre_cas_producto', 'cas', 'fds', 'tipo', 'caducidad', 'concentracion', 'tipo_concentracion', 'capacidad', 'estado', 'armario', 'balda', 'h_producto', 'desc')->get();
    return view('dashboard', ['casProductos' => $casProductos]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
