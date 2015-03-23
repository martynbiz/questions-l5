<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tags', function(Blueprint $table)
		{
			$table->increments('id');
			
			/// fields
			
			$table->string('name');
			
			$table->timestamps();
		});
		
		Schema::create('question_tag', function(Blueprint $table)
		{
			$table->increments('id');
			
			/// fields
			
			$table->integer('question_id')
				->unsigned()
				->index();
			
			$table->integer('tag_id')
				->unsigned()
				->index();
			
			$table->timestamps();
			
			// foreign keys
			
			// question_id foreign key relationship 
			$table->foreign('question_id')
				->references('id')
				->on('questions')
				->onDelete('cascade');
			
			// tag_id foreign key relationship 
			$table->foreign('tag_id')
				->references('id')
				->on('tags')
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
		Schema::drop('tags');
		Schema::drop('question_tag');
	}

}
