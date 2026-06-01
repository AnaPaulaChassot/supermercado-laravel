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
        Schema::create('venda_produtos', function (Blueprint $table) {
             $table->id();

            // Venda
            $table->foreignId('venda_id')
                ->constrained('vendas')
                ->onDelete('cascade');

            // Produto
            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->onDelete('cascade');

            // Quantidade comprada
            $table->integer('quantidade');

            // Subtotal do item
            $table->decimal('subtotal', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_produtos');
    }
};
