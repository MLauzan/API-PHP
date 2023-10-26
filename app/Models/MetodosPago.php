<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MetodosPago extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['tipo'];
    protected $table = 'metodos_pago';

}
