<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationReqsTable extends Migration {

	public function up()
	{
              
		Schema::create('donation_reqs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			
			$table->integer('city_id')->unsigned();
			$table->integer('blood_type_id')->unsigned();
			$table->string('hospital_name');
			$table->date('donation_ago');
			$table->string('hospital_address', 150);
			$table->integer('bags_num');
			
			$table->text('details');
		});
	}

	public function down()
	{
		Schema::drop('donation_reqs');
	}
}