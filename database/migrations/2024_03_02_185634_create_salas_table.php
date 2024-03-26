<?php

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
        Schema::create('salas', function (Blueprint $table) {
            $table->bigInteger('idSala',false);
            $table->unsignedBigInteger('idCine',false);
            $table->string('pelicula')->nullable();
            $table->integer('aforo')->nullable();
            $table->tinyInteger('es3d')->nullable();
            //$table->integer('idCine')->unique(false)->change();
            $table->primary(['idSala','idCine']);
            $table->foreign('idCine')->references('id')->on('cines')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salas');
    }
};
