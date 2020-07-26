<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionDetailsRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->integer('transaction_id')->unsigned()->change();
            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->change();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropForeign('transaction_details_transaction_id_foreign');
            $table->dropIndex('transaction_details_transaction_id_foreign');
            $table->integer('transaction_id')->change();
            $table->dropForeign('transaction_details_product_id_foreign');
            $table->dropIndex('transaction_details_product_id_foreign');
            $table->integer('product_id')->change();
        });
    }
}
