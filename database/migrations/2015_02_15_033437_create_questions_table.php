<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			
			// fields
			
			$table->string('title');
			$table->string('slug');
			$table->text('content');
			$table->integer('user_id')
				->unsigned()
				->index();
			$table->integer('is_approved')
				->unsigned();
			
			$table->softDeletes();
			$table->timestamps();
			
			
			// foreign keys
			
			// question_id foreign key relationship 
			$table->foreign('user_id')
				->references('id')
				->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('questions');
	}

}
