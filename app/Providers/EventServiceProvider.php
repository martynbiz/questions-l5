<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Tag;
use App\Question;
use App\Answer;

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
		
		// set Question slug, clear cache (create, update)
		Question::saving(function($question)
		{
		    //slugify name
		    $question->slug = Str::slug($question->title);
			
			// empty the cache
		    Question::emptyCache();
		});
		
		// clear the cache when deleting
		Question::deleting(function($question)
		{
			// cascades
			$question->answers()->delete();
			$question->tags()->detach();
			$question->follows()->delete();
			
			// empty the cache
		    Question::emptyCache();
		});
		
		// clear the cache when deleting
		Answer::deleting(function($question)
		{
			// cascades
			$question->votes()->delete();
			
			// empty the cache
		    Question::emptyCache();
		});
		
		// set Tag slug, clear cache (create, update)
		Tag::saving(function($tag)
		{
		    //slugify name
		    $tag->slug = Str::slug($tag->name);
		    
		    // empty the cache
		    Tag::emptyCache();
		});
		
		// clear the cache when deleting
		Tag::deleting(function($tag)
		{
		    // cascades
			$tag->questions->detach();
		    
		    // empty the cache
		    Tag::emptyCache();
		});
		
		

		// // ** not sure where yet to put this
		// $theme = \Config::get('themes.theme');
		// $altPath = base_path() . '/themes/' . $theme . '/views/';

		// // echo $altPath; exit;

		// \View::addLocation($altPath);
	}

}
