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
        Schema::create('commutateurs', function (Blueprint $table) {
            $table->id();
            $table->integer('num');
            $table->integer('nbport');
            $table->integer('nbportdispo');
            $table->unsignedBigInteger('batiment_id')->default(null);
            $table->foreign('batiment_id')->references('id')->on('batiments')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commutateurs');
    }
};
