<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


use function Laravel\Prompts\table;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id()->unique();
            $table->unsignedBigInteger('carrito_id')->unique();
            $table->unsignedBigInteger('metodo_pago_id');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->foreign("metodo_pago_id")->references('id')->on('metodos_pago');            
            $table->foreign("carrito_id")->references('id')->on('carritos');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};

