<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Model extends Eloquent {

    use SoftDeletes;
    
    /**
     * This just stops pivot appearing in the result
     */
    protected $hidden = array('pivot');
    
    // attributes
    
    /**
     * Return a human readable created_at datetime
     * @return string
     */
    protected function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    
    /**
     * Return a human readable updated_at datetime
     * @return string
     */
    protected function getUpdatedAtFormattedAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
    
    /**
     * Return a human readable deleted_at datetime
     * @return string
     */
    protected function getDeletedAtFormattedAttribute()
    {
        return Carbon::parse($this->deleted_at)->diffForHumans();
    }

}
