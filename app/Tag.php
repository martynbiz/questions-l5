<?php namespace App;

use Cache;

class Tag extends Model {

	/**
     * Protect against mass assignment
     * Note: slug is automatically created on save - see EventServiceProvider
     */
    protected $fillable = [
        'name',
    ];
    
    
    // relationships
    
    /**
    * Get the questions associated with this tag
    * @return \Illuminte\Database\Eloquent\Relations\BelongsToMany
    */ 
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }
    
    
    // attributes
    
    /**
     * Fetch the total number of questions for this tag
     * @return integer
     */
    protected function getTotalQuestionsAttribute()
    {
        return $this->questions->count();
    }
    
    
    // custom functions
    
    /**
     * Clear the cache. This should contain all general items (e.g. tags)
     * This will be set in EventServiceProvider to clear cache on every save
     * and delete
     */
    protected function emptyCache()
    {
        Cache::forget('tags');
    }
}
