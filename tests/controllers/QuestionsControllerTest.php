<?php

class QuestionsControllerTest extends TestCase {

    protected $mock;
    
    public function __construct()
    {
        // We have no interest in testing Eloquent
        // $this->mock = Mockery::mock('Eloquent', 'Question');
        $this->mock = Mockery::mock('App\Question');
    }
    
    public function tearDown()
    {
        Mockery::close();
    }
    
    public function testQuestionIndex()
    {
        // var_dump(get_class($this->mock)); exit; // outputs Mockery_0_App_Question
        // var_dump(get_class($this->app)); exit; // Illuminate\Foundation\Application
        
        $this->mock
           ->shouldReceive('latest')
           ->once();
        
        $this->app->instance('Question', $this->mock);
        
        
        // dispatch route
        
        $response = $this->call('GET', 'questions');
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('questions');
        
        // getData() returns all vars attached to the response.
        $questions = $response->original->getData()['questions'];
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $questions);

        // $this->assertResponseOk();
        // $this->assertViewHas('questions');
        //$this->assertEquals(200, $response->getStatusCode());
        // $this->assertResponseStatus(403);
        // $this->assertRedirectedTo('foo');
        // $this->assertRedirectedToRoute('route.name');
        // $this->assertRedirectedToAction('Controller@method');
        // $this->assertViewHas('name');
        // $this->assertViewHas('age', $value);
        // $this->assertSessionHas('name');
        // $this->assertSessionHas('age', $value);
    }

}