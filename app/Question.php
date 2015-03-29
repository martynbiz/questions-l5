<?php namespace App;

class Question extends Model {
    
    /**
     * Protect against mass assignment
     */
	protected $fillable = [
        'title',
        'content',
        'slug',
    ];
    
    /**
     * @var Cache object
     */
    // protected $cache;
    
    /**
     * This let's us pass in the Cache object (so we can mock it)
     * @param Cache $cache
     */
    // public function __construct($cache=null)  {
    //     parent::__construct();
        
    //     // set the cache
    //     $this->cache = $cache;
    // }
    
    
    
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

}
