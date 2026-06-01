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
        Schema::create('foto_produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome_arquivo');

            // Relacionamento com produto
            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->onDelete('cascade');

            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_produtos');
    }
};
