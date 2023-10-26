<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['carrito_id', 'producto_id', 'cantidad', 'importe'];

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }
}
