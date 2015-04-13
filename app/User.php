<?php namespace App;

// use Illuminate\Auth\Authenticatable;
use App\Metroworks\SamlAuth\Authenticatable;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'email']; // notification emails? :/
    
    /**
    * This article is owned by user
    * @return \Illuminte\Database\Eloquent\Relations\HasMany
    */    
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    
    /**
    * This article is owned by user
    * @return \Illuminte\Database\Eloquent\Relations\HasMany
    */    
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    
    
    // access stuff
    
    /**
     * 
     */
    public function isAdmin() {
        return ($this->role == 'admin');
    }
    
    /**
     * 
     */
    public function isAnswerer() {
        return ($this->role == 'answerer');
    }
    
    /**
     * 
     */
    public function isSubscriber() {
        return ($this->role == 'subscriber');
    }
     
    /**
     * Checks if the item passed belongs to this user
     */
    public function isOwnerOf($item) {
        return ($item->user_id == $this->id);
    }
    
    /**
     * Checks if the user is the owner of the item, or admin
     */
    public function canUpdate($item) {
        return ($this->isAdmin() or $item->user_id == $this->id);
    }
     
    /**
     * Checks if the user is the owner of the item, or admin
     */
    public function canDelete($item) {
        return ($this->isAdmin() or $item->user_id == $this->id);
    }
     
    /**
     * Check if this question has been answered already by this user
     */
    public function hasAnswered($question) {
        foreach($question->answers as $answer) {
            if ($answer->user_id == $this->id) {
                return true;
            }
        }
        
        return false;
    }
}
