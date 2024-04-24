<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto'; // Especificamos la clave primaria personalizada
    public $incrementing = false; // Desactivamos la auto-incrementación para la clave primaria
    protected $keyType = 'string'; // Indicamos que el tipo de la clave primaria es string

    protected $fillable = [
        'id_producto',
        'id_cas',
        'concentracion',
        'tipo_concentracion',
        'caducidad',
        'capacidad',
        'armario',
        'balda',
        'fecha_entrada'
    ];

    public function casProducto()
    {
        return $this->belongsTo(CasProducto::class, 'id_cas', 'id');
    }

    public function valoresH(): BelongsToMany
    {
        return $this->belongsToMany(HDesc::class, 'h_producto', 'id_producto', 'h');
    }

    public function historiales(): HasMany
    {
        return $this->hasMany(Historial::class, 'id_producto', 'id_producto');
    }
}
