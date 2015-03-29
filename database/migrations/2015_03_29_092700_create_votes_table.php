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
			$table->integer('voteable_id')
				->unsigned()
				->index();
			
			// voteable_type -- "question", "answer", etc
			$table->string('voteable_type');
			
			// value -- value of the vote (e.g. 1, -1)
			$table->integer('value');
			
			
			// timestamps
			
			$table->softDeletes();
			$table->timestamps();
			
			
			// foreign keys
			
			$table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('set null');
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
