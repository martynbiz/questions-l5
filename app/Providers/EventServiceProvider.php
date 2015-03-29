<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Tag;
use App\Question;

use Illuminate\Support\Str;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
		
		// set Tag slug
		Question::saving(function($question)
		{
		    //slugify name
		    $question->slug = Str::slug($question->title);
		});
		
		// set Tag slug
		Tag::saving(function($tag)
		{
		    //slugify name
		    $tag->slug = Str::slug($tag->name);
		});
	}

}
