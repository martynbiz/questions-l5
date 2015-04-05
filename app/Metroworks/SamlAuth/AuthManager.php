<?php namespace App\Metroworks\SamlAuth;

use Illuminate\Support\Manager;

class AuthManager extends Manager {

	/**
	 * Create a new driver instance.
	 *
	 * @param  string  $driver
	 * @return mixed
	 */
	protected function createDriver($driver)
	{
		$guard = parent::createDriver($driver);

		// When using the remember me functionality of the authentication services we
		// will need to be set the encryption instance of the guard, which allows
		// secure, encrypted cookie values to get generated for those cookies.
		$guard->setCookieJar($this->app['cookie']);

		$guard->setDispatcher($this->app['events']);

		return $guard->setRequest($this->app->refresh('request', $guard, 'setRequest'));
	}

	/**
	 * Call a custom driver creator.
	 *
	 * @param  string  $driver
	 * @return \App\Metroworks\SamlAuth\Guard
	 */
	protected function callCustomCreator($driver)
	{
		$custom = parent::callCustomCreator($driver);

		if ($custom instanceof Guard) return $custom;

		return new Guard($custom, $this->app['session.store']);
	}

	/**
	 * Create an instance of the database driver.
	 *
	 * @return \App\Metroworks\SamlAuth\Guard
	 */
	public function createDatabaseDriver()
	{
		$provider = $this->createDatabaseProvider();

		return new Guard($provider, $this->app['session.store']);
	}

	/**
	 * Create an instance of the database user provider.
	 *
	 * @return \App\Metroworks\SamlAuth\DatabaseUserProvider
	 */
	protected function createDatabaseProvider()
	{
		$connection = $this->app['db']->connection();

		// When using the basic database user provider, we need to inject the table we
		// want to use, since this is not an Eloquent model we will have no way to
		// know without telling the provider, so we'll inject the config value.
		$table = $this->app['config']['auth.table'];

		return new DatabaseUserProvider($connection, $this->app['hash'], $table);
	}

	/**
	 * Create an instance of the Eloquent driver.
	 *
	 * @return \App\Metroworks\SamlAuth\Guard
	 */
	public function createEloquentDriver()
	{
		$provider = $this->createEloquentProvider();

		return new Guard($provider, $this->app['session.store']);
	}

	/**
	 * Create an instance of the Eloquent user provider.
	 *
	 * @return \App\Metroworks\SamlAuth\EloquentUserProvider
	 */
	protected function createEloquentProvider()
	{
		$model = $this->app['config']['auth.model'];

		return new EloquentUserProvider($this->app['hash'], $model);
	}

	/**
	 * Get the default authentication driver name.
	 *
	 * @return string
	 */
	public function getDefaultDriver()
	{
		return $this->app['config']['auth.driver'];
	}

	/**
	 * Set the default authentication driver name.
	 *
	 * @param  string  $name
	 * @return void
	 */
	public function setDefaultDriver($name)
	{
		$this->app['config']['auth.driver'] = $name;
	}

}
