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
            // chinh sua kieu du lieu
            $table -> bigInteger('category_id') -> change(); // Dùng khi cần lưu số lớn 
            $table -> unsignedInteger('price') -> change(); // để cho kiểu int kh bị âm
            $table -> unsignedInteger('quantity') -> change();
            // them cot
            $table -> text('description') -> after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // tra kieu du lieu ve ban dau
            $table -> integer('category_id') -> change(); 
            $table -> integer('price') -> change();
            $table -> integer('quantity') -> change();
            // xoa cot
            $table -> dropColumn('description');
        });
    }
};
