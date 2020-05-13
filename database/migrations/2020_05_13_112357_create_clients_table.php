<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->date('date_of_birth');
			$table->string('username');
			$table->string('password');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->date('last_donation');
			$table->string('phone');
			$table->string('pin_code')->nullable();
			$table->string('email');
			$table->string('api_token', 250);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}