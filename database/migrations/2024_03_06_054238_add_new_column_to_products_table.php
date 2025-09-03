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
        Schema::table('products', function (Blueprint $table) {
            $table->longText('short_description')->nullable();
            $table->date('date_sale_price_ends')->nullable();
            $table->boolean('tax_status')->default(false);
            $table->string('tax_class')->nullable();
            $table->boolean('in_stock')->default(true);
            $table->integer('low_stock_amount')->default(10);
            $table->boolean('backorders_allowed')->default(false);
            $table->boolean('sold_individually')->default(false);
            $table->double('weight', 8, 2)->nullable();
            $table->double('length', 8, 2)->nullable();
            $table->double('width', 8, 2)->nullable();
            $table->double('height', 8, 2)->nullable();
            $table->boolean('allow_customer_reviews')->default(true);
            $table->longText('purchase_note')->nullable();
            $table->double('sale_price', 10, 2)->nullable();
            $table->string('external_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
