<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('quotation_id')
                ->constrained('quotations')
                ->cascadeOnDelete();

            $table->string('item_name');

            $table->decimal('quantity', 15, 2);

            $table->decimal('unit_price', 15, 2);

            $table->decimal('discount', 15, 2)
                ->default(0);

            $table->decimal('tax_percentage', 5, 2)
                ->default(0);

            $table->decimal('line_total', 15, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};