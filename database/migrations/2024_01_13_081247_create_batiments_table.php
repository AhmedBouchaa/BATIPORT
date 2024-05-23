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
        Schema::create('batiments', function (Blueprint $table) {
            //attribut
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id')->default(null);
            $table->integer('nbetage');
            $table->integer('nbcommut');
            $table->text('descr');        
            $table->text('type_reseaux');
            $table->text('adresse_reseau');
            $table->string('image');
            //constraint
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batiments');
    }
};
