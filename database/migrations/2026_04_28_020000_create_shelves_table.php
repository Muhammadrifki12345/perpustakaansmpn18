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
        Schema::create('shelves', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Rak A1"
            $table->string('location_code')->nullable(); // e.g. "A1-01"
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Add shelf_id to books table
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('shelf_id')->nullable()->after('category_id')->constrained('shelves')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['shelf_id']);
            $table->dropColumn('shelf_id');
        });
        Schema::dropIfExists('shelves');
    }
};
