<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientGovernTable extends Migration {

	public function up()
	{
		Schema::create('client_govern', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned();
			$table->integer('govern_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_govern');
	}
}