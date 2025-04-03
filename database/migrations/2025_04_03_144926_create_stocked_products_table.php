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
        // Criando a tabela de setores
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Criando a tabela de locais de estoque
        Schema::create('stock_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Criando a tabela de fornecedores
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Criando a tabela de produtos estocados
        Schema::create('stocked_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('supplier_id');
            $table->string('category');
            $table->unsignedBigInteger('stock_location_id');
            $table->timestamps();

            // Definição de chaves estrangeiras
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('stock_location_id')->references('id')->on('stock_locations')->onDelete('cascade');
        });

        // Criando a tabela de entradas de produtos
        Schema::create('product_entries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stocked_product_id');
            $table->dateTime('entry_date');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->unsignedBigInteger('supplier_id');
            $table->timestamps();

            // Definição de chaves estrangeiras
            $table->foreign('stocked_product_id')->references('id')->on('stocked_products')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        // Criando a tabela de saídas de produtos
        Schema::create('product_outputs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stocked_product_id');
            $table->unsignedBigInteger('sector_id');
            $table->dateTime('output_date');
            $table->string('requestor_name');
            $table->integer('quantity');
            $table->timestamps();

            // Definição de chaves estrangeiras
            $table->foreign('stocked_product_id')->references('id')->on('stocked_products')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_outputs');
        Schema::dropIfExists('product_entries');
        Schema::dropIfExists('stocked_products');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('stock_locations');
        Schema::dropIfExists('sectors');
    }
};
