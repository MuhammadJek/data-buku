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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title');
            $table->string('image');
            $table->string('description');
            $table->integer('price');
            $table->integer('jumlah');
            $table->unsignedBigInteger('author');
            $table->unsignedBigInteger('penerbit_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('penerbit_id')->references('id')->on('penerbits')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
