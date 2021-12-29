<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caves', function (Blueprint $table) {
            $table->id();
            $table->string('cave_Number');
            $table->string('cave_name');
            $table->string('site_type');
            $table->integer('country_id');
            $table->integer('province_id');
            $table->text('cave_description');
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
        Schema::dropIfExists('caves');
    }
}
