<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSexyActressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sexy_actresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->nullable();
			$table->string('name')->nullable();
			$table->string('image_name')->nullable();
			$table->string('introduction')->nullable();
			$table->string('feature')->nullable();
			$table->timestamps();
			$table->string('purchase_link')->nullable();
			$table->integer('searched_count');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sexy_actresses');
	}

}
