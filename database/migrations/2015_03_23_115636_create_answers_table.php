<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id');
			
			/// fields
			
			$table->string('content');
			$table->integer('question_id')
				->unsigned()
				->index();
			$table->integer('user_id')
				->unsigned()
				->index();
			
			$table->timestamps();
			
			// foreign keys
			
			// question_id foreign key relationship 
			$table->foreign('question_id')
				->references('id')
				->on('questions')
				->onDelete('cascade');
			
			// user_id foreign key relationship 
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('answers');
	}

}
