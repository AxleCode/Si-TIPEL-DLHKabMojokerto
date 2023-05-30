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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_aduan_id');
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('telpon');
            $table->string('email');
            $table->string('judul');
            $table->text('body');
            $table->text('coordinates');
            $table->text('address');
            $table->integer('status');
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
