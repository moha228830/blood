<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationReqsTable extends Migration {

	public function up()
	{
		Schema::create('donation_reqs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name');
			$table->string('patient_phone');
			$table->integer('city_id')->unsigned();
			$table->integer('blood_type_id')->unsigned();
			$table->string('hospital_name');
			$table->string('age');
			$table->string('hospital_address', 150);
			$table->integer('bags_num');
			$table->text('details')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('donation_reqs');
	}
}