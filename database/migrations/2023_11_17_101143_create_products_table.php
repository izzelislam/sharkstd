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
            $table->foreignId("product_category_id");
            $table->foreignId("admin_id");
            $table->string("name");
            $table->text("slug");
            $table->longText("describtion");
            $table->integer("file_size");
            $table->text("file");
            $table->float("price");
            $table->float("promo")->nullable();
            $table->tinyInteger("is_free")->default(0);
            $table->tinyInteger("status")->default(1);
            $table->softDeletes();
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
