<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->enum('type',['category','tag','other']);
            $table->string('for',25);
            $table->bigInteger('logo')->nullable();
            $table->string('bg_color',20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories_tags');
    }
};
