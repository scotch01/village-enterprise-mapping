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
        Schema::create('usaha', function (Blueprint $table) {
            $table->id();

            $table->foreignId('desa_id')
                ->constrained('desa')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // BLOK I (core identitas usaha)
            $table->string('nama_usaha');
            $table->text('alamat')->nullable();

            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('foto')->nullable();

            $table->timestamps();

            // index penting
            $table->index('desa_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usahas');
    }
};
