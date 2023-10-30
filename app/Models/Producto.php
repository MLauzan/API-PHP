<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['nombre', 'precio', 'imagen', 'descripcion', 'categoria_id', 'habilitado'];
    protected $hidden = ['categoria_id', 'habilitado'];
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
