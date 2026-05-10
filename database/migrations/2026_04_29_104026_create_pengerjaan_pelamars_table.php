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
        Schema::create('pengerjaan_pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pelamar')->constrained('pelamars')->cascadeOnDelete();
            $table->foreignId('id_kuis')->constrained('kuis')->cascadeOnDelete();
            $table->enum('status', ['pending', 'lulus', 'gagal'])->default('pending');
            $table->integer('nilai')->nullable();
            $table->timestamps();

            $table->unique(['id_pelamar', 'id_kuis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengerjaan_pelamars');
    }
};
