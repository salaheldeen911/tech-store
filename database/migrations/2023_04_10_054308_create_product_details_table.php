<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->boolean("fast_charge")->nullable();
            $table->boolean("smart")->nullable();
            $table->boolean("built_in_receiver")->nullable();
            $table->text("description")->nullable();
            $table->boolean("dual_sim_card")->nullable();
            $table->boolean("curved")->nullable();
            $table->smallInteger("storage")->nullable();
            $table->smallInteger("ram")->nullable();
            $table->float("screen_size", 5, 1)->nullable();
            $table->smallInteger("battery")->nullable();
            $table->smallInteger("main_camera")->nullable();
            $table->smallInteger("front_camera")->nullable();

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('operating_system_id')->nullable();
            $table->unsignedBigInteger('processor_id')->nullable();
            $table->unsignedBigInteger('screen_type_id')->nullable();
            $table->unsignedBigInteger('resolution_id')->nullable();
            $table->unsignedBigInteger('network_id')->nullable();
            $table->unsignedBigInteger('refresh_rate_id')->nullable();

            $table->foreign('product_id')->references("id")->on("products")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('operating_system_id')->references("id")->on("operating_systems")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('processor_id')->references("id")->on("processors")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('resolution_id')->references("id")->on("resolutions")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('screen_type_id')->references("id")->on("screen_types")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('network_id')->references("id")->on("networks")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign('refresh_rate_id')->references("id")->on("refresh_rates")->onDelete("cascade")->onUpdate("cascade");

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
        Schema::dropIfExists('product_details');
    }
}
