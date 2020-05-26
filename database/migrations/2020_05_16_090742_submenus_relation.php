<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubmenusRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submenus', function (Blueprint $table) {
            $table->integer('menu_id')->unsigned()->change();
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submenus', function (Blueprint $table) {
            $table->dropForeign('submenus_menu_id_foreign');
            $table->dropIndex('submenus_menu_id_foreign');
            $table->integer('menu_id');
        });
    }
}
