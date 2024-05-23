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
        Schema::create('bureaux', function (Blueprint $table) {
            //attribut
            $table->id();
            $table->string('titre')->nullable();
            $table->integer('num');
            $table->unsignedBigInteger('etage_id')->default(null);
            $table->integer('nbport');
            //constraint
            $table->foreign('etage_id')->references('id')->on('etages')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bureaux');
    }
};
