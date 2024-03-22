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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id(); // Tự động tăng và khóa chính
            $table->string('username'); // Trường text
            $table->string('fullname'); // Trường text
            $table->string('avatar')->nullable(); // Thêm cột avatar để lưu trữ đường dẫn của ảnh, cho phép giá trị null
            $table->integer('age'); // Trường integer
            $table->text('address'); // Trường text
            $table->timestamps(); // Tự động thêm cột created_at và updated_at
            $table->softDeletes(); // Thêm cột deleted_at cho xóa mềm
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
