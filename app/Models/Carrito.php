<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['usuario_id', 'finalizado'];
    protected $hidden = ['finalizado', 'usuario_id'];
    
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
