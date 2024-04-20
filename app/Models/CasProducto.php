<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasProducto extends Model
{
    protected $table ='cas_productos';
    protected $primaryKey = 'id'; // Definir el campo 'id' como la clave primaria
    public $incrementing = false; // Desactivar la auto-incrementación para la clave primaria
    protected $keyType = 'string'; // Indicar que el tipo de dato de la clave primaria es string

    protected $fillable = [
        'id',
        'cas',
        'nombre',
        'fds',
        'estado',
        'tipo',
    ];
    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class, 'id_cas', 'id');
    }
}
