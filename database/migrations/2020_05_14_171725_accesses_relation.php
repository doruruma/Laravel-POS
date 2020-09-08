<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccessesRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accesses', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->change();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('accesses', function (Blueprint $table) {
            $table->dropForeign('accesses_role_id_foreign');
            $table->dropIndex('accesses_role_id_foreign');
            $table->integer('role_id');
            $table->dropForeign('accesses_menu_id_foreign');
            $table->dropIndex('accesses_menu_id_foreign');
            $table->integer('menu_id');
        });
    }
}
