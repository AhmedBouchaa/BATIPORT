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
        Schema::create('etages', function (Blueprint $table) {
            //attributs
            $table->id();
            $table->integer('num');
            $table->unsignedBigInteger('batiment_id')->default(null);
            $table->integer('nbbureau');
            //constraint
            $table->foreign('batiment_id')->references('id')->on('batiments')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etages');
    }
};
