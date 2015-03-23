<?php namespace App;

class Follow extends Model {

    /**
    * Get the question associated with this follow
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */ 
    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    /**
    * Get the user associated with this follow
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */ 
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
