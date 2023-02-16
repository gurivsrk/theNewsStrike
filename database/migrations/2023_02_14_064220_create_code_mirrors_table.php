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
        Schema::create('code_mirrors', function (Blueprint $table) {
            $table->id();
            $table->string('page_name',100);
            $table->enum('type',['javascript','css','html']);
            $table->text('code');
            $table->enum('linking',['internal','external']);
            $table->enum('where',['head','footer','body']);
            $table->string('slug',150);
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
        Schema::dropIfExists('code_mirrors');
    }
};
