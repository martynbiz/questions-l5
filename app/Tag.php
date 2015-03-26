<?php namespace App;

class Tag extends Model {

	/**
     * Protect against mass assignment
     * Note: slug is automatically created on save - see EventServiceProvider
     */
    protected $fillable = [
        'name',
    ];
    
    
    /**
    * Get the questions associated with this tag
    * @return \Illuminte\Database\Eloquent\Relations\BelongsToMany
    */ 
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }
}
