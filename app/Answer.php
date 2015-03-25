<?php namespace App;

class Answer extends Model {
    
	protected $fillable = [
        'content',
        'question_id',
    ];
    
    /**
    * Get the user who owns this question
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */    
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
    
    /**
    * Get the user who owns this question
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
