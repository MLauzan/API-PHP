<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Orden extends Model
{
    use HasFactory;


    public $timestamps = false;
    protected $fillable = ['carrito_id', 'metodo_pago_id'];
    protected $table = 'ordenes';
    protected $hidden = ['carrito_id', 'metodo_pago_id'];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }


    public function metodo_pago()
    {
        return $this->belongsTo(MetodosPago::class, 'metodo_pago_id');
    }
}
