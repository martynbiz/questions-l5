<?php namespace App;

class Tag extends Model {

	/**
    * Get the questions associated with this tag
    * @return \Illuminte\Database\Eloquent\Relations\BelongsToMany
    */ 
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }

}
