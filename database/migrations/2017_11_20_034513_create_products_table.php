<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->integer('category_id');
            $table->string('jan',20);
            $table->string('name',50);
            $table->text('description')->nullable();
            $table->tinyInteger('color')->nullable();
            $table->tinyInteger('size')->nullable();
            $table->tinyInteger('suitable_age')->nullable();
            $table->tinyInteger('suitable_gender')->nullable();
            $table->string('material',100)->nullable();
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
        Schema::drop('products');
    }
}
