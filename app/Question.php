<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $fillable = [
        'title',
        'content',
        'slug',
    ];
    
    /**
    * This article is owned by user
    * 
    * @return \Illuminte\Database\Eloquent\Relations\BelongsTo
    */    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
