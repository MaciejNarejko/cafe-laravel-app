<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoriesToTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('types', function (Blueprint $table) {
        $table->foreign('id_category')->references('id')->on('categories');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::table('types', function (Blueprint $table) {
              $table->dropForeign('types_id_category_foreign');
          });
    }
}
