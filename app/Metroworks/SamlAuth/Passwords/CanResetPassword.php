<?php namespace App\Metroworks\SamlAuth\Passwords;

trait CanResetPassword {

	/**
	 * Get the e-mail address where password reset links are sent.
	 *
	 * @return string
	 */
	public function getEmailForPasswordReset()
	{
		return $this->email;
	}

}
