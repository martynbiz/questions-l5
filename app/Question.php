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

}
