<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('caves', function(Blueprint $table) {
            $table->string('cave_name')->nullable()->change();
            $table->string('site_type')->nullable()->change();
            $table->integer('country_id')->nullable()->change();
            $table->integer('province_id')->nullable()->change();
            $table->text('cave_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('caves', function(Blueprint $table) {
            $table->string('cave_name')->nullable(false)->change();
            $table->string('site_type')->nullable(false)->change();
            $table->integer('country_id')->nullable(false)->change();
            $table->integer('province_id')->nullable(false)->change();
            $table->text('cave_description')->nullable(false)->change();
        });
    }
}
