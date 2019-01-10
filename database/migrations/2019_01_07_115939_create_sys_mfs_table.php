<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysMfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_mfs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sys_mf_desc');
            $table->string('sys_url');
            $table->string('sys_status');
            $table->string('sys_menu_cat_code');
            $table->string('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_mfs');
    }
}
