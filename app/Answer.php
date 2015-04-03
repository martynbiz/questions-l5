<?php namespace App;

class Answer extends Model {
    
	protected $fillable = [
        'content',
        'question_id',
        'is_approved',
    ];
    
    /**
    * Get the question who owns this answer
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */    
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    
    /**
    * Get the user who owns this ansswer
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    /**
    * Get the votes for this answer
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */    
    public function votes()
    {
        return $this->belongsTo('App\Vote');
    }
    
    
    // attributes
    
    /**
     * Return the total number of follows
     * @return integer
     */
    protected function getTotalVotesAttribute()
    {
        return count($this->votes);
    }
}
