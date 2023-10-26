<?php

use App\Models\Categoria;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id()->unique();
            $table->string("nombre", 255);
            $table->double("precio")->unsigned();
            $table->string("imagen", 255)->nullable();
            $table->string("descripcion", 255)->nullable();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->boolean("habilitado")->default(1);

            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
