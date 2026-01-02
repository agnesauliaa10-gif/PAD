<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update Users Table for Roles
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['supervisor', 'staff'])->default('staff')->after('email');
        });

        // 2. Update Products Table for Types
        Schema::table('products', function (Blueprint $table) {
            $table->enum('type', ['raw_material', 'finished_good'])->default('raw_material')->after('category_id');
        });

        // 3. Create Product Batches Table
        Schema::create('product_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('batch_number');
            $table->integer('quantity')->default(0); // Current quantity in this batch
            $table->date('received_date')->nullable();
            $table->timestamps();
        });

        // 4. Update Transactions to link to Batches
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignId('product_batch_id')->nullable()->after('product_id')->constrained('product_batches')->onDelete('set null');
        });

        // 5. Create Stock Adjustments Table (Stock Opname)
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Who adjusted it
            $table->foreignId('product_batch_id')->nullable()->constrained('product_batches')->onDelete('set null');
            $table->integer('quantity_diff'); // e.g., -5 or +10
            $table->string('reason'); // e.g., "Broken", "Found", "Stock Opname"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['product_batch_id']);
            $table->dropColumn('product_batch_id');
        });

        Schema::dropIfExists('product_batches');

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
