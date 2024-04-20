<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class H extends Model
{
    protected $table = 'h_desc';
    protected $primaryKey = 'h';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'h',
        'desc',
    ];
    public function productos(): BelongsToMany
    {
        return $this->belongsToMany(Producto::class, 'h_producto', 'h', 'id_producto');
    }
}
