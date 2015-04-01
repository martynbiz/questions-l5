<?php namespace App\Services;

use Mail;

use App\User;
use App\Question;
use App\Answer;

class Notify {
	
	/**
	 * Send welcome email to new member
	 *
	 * @param App\User $user The new user
	 * @return bool?
	 */
	public function toNewUserReNewRegistration(User $user)
	{
		$adminEmail = self::getAdminEmail();
		$adminName = self::getAdminName();
		
		return Mail::send('emails.auth.welcome', compact('user'), function($m) use ($user, $adminEmail, $adminName) {
            $m->to($user->email, $user->name);
            $m->sender($adminEmail, $adminName); // put in config
            $m->subject('Welcome to JapanTravel');
        });
	}

	/**
	 * Notify the question owner that someone answered their question
	 *
	 * @param  App\Answer  $answer This is the new answer
	 * @return bool?
	 */
	public function toQuestionOwnerReNewAnswer(Answer $answer)
	{
		$adminEmail = self::getAdminEmail();
		$adminName = self::getAdminName();
		
		return Mail::send('emails.answers.question_owner', compact('answer'), function($m) use ($answer, $adminEmail, $adminName) {
            $m->to($answer->question->user->email, $answer->question->user->name);
            $m->sender($adminEmail, $adminName); // put in config
            $m->subject('New answer to "' . $answer->question->title . '"');
        });
	}
	 /**
	  * Send an email to each person that is following
	  *
	  * @param App\Answer $answer The new answer
	  * @return bool?
	  */
	public function toQuestionFollowersReNewAnswer(Answer $answer)
	{
		$adminEmail = self::getAdminEmail();
		$adminName = self::getAdminName();
		
		foreach($answer->question->follows as $follow) {
			return Mail::send('emails.answers.follower', compact('follow', 'answer'), function($m) use ($follow, $answer, $adminEmail, $adminName) {
	            $m->to($follow->user->email, $follow->user->name);
	            $m->sender($adminEmail, $adminName);
	            $m->subject($answer->name . ' gave an answer to a question you\'re following');
	        });
		}
	}
	
	/**
	 * Get the admin email address (most likely from config)
	 * @return string Email address
	 */
	protected static function getAdminEmail()
	{
		return Config::get('app.admin_email');
	}
	
	/**
	 * Get the admin name (most likely from config)
	 * @return string Name
	 */
	protected static function getAdminName()
	{
		return Config::get('app.admin_name');
	}
}
