<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignMenusToOrderPostions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('order_positions', function (Blueprint $table) {
        $table->foreign('id_menu')->references('id')->on('menus');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('order_positions', function (Blueprint $table) {
          $table->dropForeign('order_positions_id_menu_foreign');
            //
        });
    }
}
