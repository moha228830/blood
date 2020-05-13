<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactMessegsTable extends Migration {

	public function up()
	{
		Schema::create('contact_messegs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 200);
			$table->longText('content');
		});
	}

	public function down()
	{
		Schema::drop('contact_messegs');
	}
}