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
        Schema::create('detail_terapis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal_terapi');
            $table->integer('berat_badan');
            $table->text('diagnosa');
            $table->enum('metode', ['Pasif', 'Aktif']);
            $table->integer('rpm')->nullable();
            $table->integer('durasi')->nullable();
            $table->string('rom')->nullable();
            $table->enum('status', ['belum', 'sudah', 'selesai'])->default('belum');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_terapis');
    }
};
