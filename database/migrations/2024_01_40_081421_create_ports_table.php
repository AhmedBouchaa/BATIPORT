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
        Schema::create('ports', function (Blueprint $table) {
            //attributs
            $table->id();
            $table->integer('num');
            $table->unsignedBigInteger('bureau_id')->default(null);
            $table->unsignedBigInteger('commutateur_id')->default(0);
            $table->boolean('active')->default(false);
            //constraint
            $table->foreign('bureau_id')->references('id')->on('bureaux')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ports');
    }
};
