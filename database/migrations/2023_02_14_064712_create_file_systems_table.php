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
        Schema::create('file_systems', function (Blueprint $table) {
            $table->id();
            $table->string('fileUrl',150);
            $table->string('fileName',100);
            $table->string('fileMime',50)->nullable();
            $table->bigInteger('fileSize')->nullable();
            $table->string('title',150)->nullable();
            $table->string('alt',150)->nullable();
            $table->string('caption',150)->nullable();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('file_systems');
    }
};
