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
    protected function getDateCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    
    /**
     * Return a human readable updated_at datetime
     * @return string
     */
    protected function getDateUpdatedAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
    
    /**
     * Return a human readable deleted_at datetime
     * @return string
     */
    protected function getDateDeletedAttribute()
    {
        return Carbon::parse($this->deleted_at)->diffForHumans();
    }

}
