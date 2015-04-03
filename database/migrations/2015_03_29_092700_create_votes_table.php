<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function(Blueprint $table)
		{
			// id
			$table->increments('id');
			
			// user_id
			$table->integer('user_id')
				->unsigned()
				->index();
			
			// voteable_id -- question_id, answer_id, etc
			$table->integer('answer_id')
				->unsigned()
				->index();
			
			// value -- value of the vote (e.g. 1, -1)
			$table->integer('value');
			
			
			// timestamps
			
			$table->softDeletes();
			$table->timestamps();
			
			
			// foreign keys
			
			$table->foreign('user_id')
				->references('id')
				->on('users');
			
			$table->foreign('answer_id')
				->references('id')
				->on('answers')
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
		Schema::drop('votes');
	}

}
