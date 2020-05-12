<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('setting_notification_text');
			$table->text('about_app');
			$table->string('contact_phone');
			$table->string('contact_email');
			$table->string('fb_link', 200);
			$table->string('tw_link', 200);
			$table->string('insta_link', 200);
			$table->string('yt_link', 200);
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}