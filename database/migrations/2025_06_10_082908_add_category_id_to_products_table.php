<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Method 'up' dijalankan saat migrate → menambahkan kolom category_id
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
           
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']); 
            $table->dropColumn('category_id');   
        });
    }
};
