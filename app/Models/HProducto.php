<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HProducto extends Model
{
    protected $table = 'h_producto';
    protected $primaryKey = ['id_producto', 'h']; // Clave primaria compuesta
    public $incrementing = false; // Desactivar la auto-incrementación para la clave primaria
    protected $keyType = 'string'; // Indicar que el tipo de dato de la clave primaria es string

    protected $fillable = [
        'id_producto',
        'h',
    ];
    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
    public function hDesc(): BelongsTo
    {
        return $this->belongsTo(H::class, 'h', 'h');
    }
}
