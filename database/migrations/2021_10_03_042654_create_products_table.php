<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("id");
            $table->string("name", 50);
            $table->string("title", 255);
            $table->boolean("used")->nullable();
            $table->string("main_image")->nullable();
            $table->float("price", 10, 2);
            $table->integer("likes")->default(0);
            $table->smallInteger("quantity");
            $table->float("discount", 10, 2)->default(0);
            $table->smallInteger("discount_percent")->default(0);
            $table->float("final_price", 10, 2)->default(0);
            $table->smallInteger("sold")->default(0);
            $table->unsignedBigInteger("seller_id");
            $table->foreign("seller_id")
                ->references("id")
                ->on("users")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->unsignedBigInteger("category_id");
            $table->foreign("category_id")
                ->references("id")
                ->on("categories")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->unsignedBigInteger("color_id");
            $table->foreign("color_id")
                ->references("id")
                ->on("colors")
                ->onDelete("cascade")
                ->onUpdate("cascade");

            $table->unsignedBigInteger("brand_id")->nullable();
            $table->foreign("brand_id")
                ->references("id")
                ->on("brands")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
