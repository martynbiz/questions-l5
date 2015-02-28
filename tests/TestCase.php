<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

}



// class TestCase extends Illuminate\Foundation\Testing\TestCase {
	
// 	/**
// 	* @var Array Collection of mocks for test cases
// 	*/
// 	protected $mocks = [];
	
	
// 	public function setUp()
//     {
//         // mock auth
        
//         // // hasMany - this is used may times in different test cases
//         // $this->mocks['hasMany'] = $this->getMockBuilder('Illuminate\Database\Eloquent\Relations\HasMany')
//         //     ->disableOriginalConstructor()
//         //     ->getMock();
        
//         // // ..and this is the questions() which returns the has many
//         // $this->mocks['authUser'] = $this->getMockBuilder('App\User')
//         //     ->disableOriginalConstructor()
//         //     ->getMock();
        
//         // // auth, receives user()
//         // $this->mocks['auth'] = $this->getMockBuilder('Illuminate\Support\Facades\Auth')
//         //     ->disableOriginalConstructor()
//         //     ->getMock();
        
//         // $this->app->instance('Illuminate\Support\Facades\Auth', $this->mocks['auth']);
        
//         // $this->mocks['auth']
//         //     ->shouldReceive('user')
//         //     ->once()
//         //     ->andReturn($this->mocks['authUser']);
//     }
	
// 	/**
// 	 * Creates the application.
// 	 *
// 	 * @return \Illuminate\Foundation\Application
// 	 */
// 	public function createApplication()
// 	{
// 		$app = require __DIR__.'/../bootstrap/app.php';

// 		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// 		return $app;
// 	}
// }