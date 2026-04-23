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
        Schema::create('jawaban_detail', function (Blueprint $table) {
            $table->id();

            $table->foreignId('jawaban_id')
                ->constrained('jawaban')
                ->cascadeOnDelete();

            $table->string('kode_pertanyaan'); // contoh: 201a, 305b

            $table->text('value')->nullable();          // single value
            $table->json('value_array')->nullable();    // checkbox
            $table->json('value_object')->nullable();   // tabel

            $table->timestamps();

            // index krusial untuk performa
            $table->index(['jawaban_id', 'kode_pertanyaan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_details');
    }
};
