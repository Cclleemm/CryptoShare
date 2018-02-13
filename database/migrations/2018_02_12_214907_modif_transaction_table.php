<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('origin_id')->unsigned();
            $table->integer('destination_id')->unsigned();
            $table->foreign('origin_id')
                  ->references('id')
                  ->on('recipients')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
            $table->foreign('destination_id')
                  ->references('id')
                  ->on('recipients')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
