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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('opening_stock')->default(0);
            $table->float('current_stock')->default(0);
            $table->float('closing_stock')->nullable();
            $table->float('packaged_qty')->default(0);
            $table->float('restocked_qty')->default(0);
            $table->float('tanzania_bulk')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
