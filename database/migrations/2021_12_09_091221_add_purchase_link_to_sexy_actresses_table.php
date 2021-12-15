<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurchaseLinkToSexyActressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sexy_actresses', function (Blueprint $table) {
            $table->string('purchase_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sexy_actresses', function (Blueprint $table) {
            $table->dropColumn('purchase_link');
        });
    }
}
