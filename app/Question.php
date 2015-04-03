<?php namespace App;

use Cache;

class Question extends Model {
    
    /**
     * Protect against mass assignment
     */
	protected $fillable = [
        'title',
        'content',
        'slug',
        'is_approved',
    ];
    
    
    // relationships
    
    /**
    * This question is owned by user
    * @return \Illuminte\Database\Eloquent\Relations\HasMany
    */    
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    
    /**
    * Get the user who owns this question
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
    * Get the tags associated with this question
    * @return \Illuminte\Database\Eloquent\Relations\BelongsToMany
    */ 
    public function tags()
    {
        return $this->belongsToMany('App\Tag')
            ->withTimestamps();
    }
    
    /**
    * This question has many follows
    * @return \Illuminte\Database\Eloquent\Relations\HasMany
    */    
    public function follows()
    {
        return $this->hasMany('App\Follow');
    }
    
    
    // query scopes
    
    /**
     * Fetch the newest questions
     */
    public function scopeNewest($query, $options=array())
    {
        return $query->with('answers')
            ->with('tags')
            ->with('user')
            ->with('follows')
            ->latest()
            ->get();
    }
    
    /**
     * Fetch the most popular questions
     */
    public function scopePopular($query)
    {
        return $query->with('answers')
            ->with('tags')
            ->with('user')
            ->with('follows')
            ->latest()
            ->get();
    }
    
    /**
     * Fetch the unanswered questions
     */
    public function scopeUnanswered($query)
    {
        return $query->with('answers')
            ->with('tags')
            ->with('user')
            ->with('follows')
            ->latest()
            ->get();
    }
    
    /**
     * Fetch the unanswered questions
     */
    public function scopeFollowing($query)
    {
        return $query->with('answers')
            ->with('tags')
            ->with('user')
            ->with('follows')
            ->latest()
            ->get();
    }
    
    
    // attributes
    
    /**
     * Return the total number of follows
     * @return integer
     */
    protected function getTotalFollowsAttribute()
    {
        return count($this->follows);
    }
    
    /**
     * Return the total number of answers
     * @return integer
     */
    protected function getTotalAnswersAttribute()
    {
        return count($this->answers);
    }
    
    
    // custom functions
    
    /**
     * Clear the cache. This should contain all general items (e.g. newest)
     * This will be set in EventServiceProvider to clear cache on every save
     * and delete
     */
    protected function emptyCache()
    {
        Cache::forget('questions_newest');
        Cache::forget('questions_popular');
        Cache::forget('questions_unanswered');
    }

}
