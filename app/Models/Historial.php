<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    use HasFactory;

    protected $table = 'historial';

    protected $fillable = ['usuario', 'id_producto', 'movimiento', 'cantidad', 'motivo', 'fecha'];
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
