<?php

class QuestionsControllerTest extends TestCase {

    protected $mocks = [];
    
    public function setUp()
    {   
        parent::setUp();
        
        $this->mocks['question'] = Mockery::mock('App\Question');
        
        $this->app->instance('App\Question', $this->mocks['question']);
        
        Session::start();
    }
    
    public function tearDown()
    {
        Mockery::close();
    }
    
    // public function testQuestionIndexGetsLatestQuestions()
    // {
    //     $this->mocks['question']
    //        ->shouldReceive('latest')
    //        ->once()
    //        ->andReturnSelf();
        
    //     $questions = new Illuminate\Database\Eloquent\Collection;
    //     $this->mocks['question']
    //         ->shouldReceive('get')
    //         ->once()
    //         ->andReturn($questions);
        
    //     // dispatch
        
    //     $response = $this->call('GET', 'questions');
        
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertViewHas('questions', $questions);
        
        

    //     // $this->assertResponseOk();
    //     // $this->assertViewHas('questions');
    //     //$this->assertEquals(200, $response->getStatusCode());
    //     // $this->assertResponseStatus(403);
    //     // $this->assertRedirectedTo('foo');
    //     // $this->assertRedirectedToRoute('route.name');
    //     // $this->assertRedirectedToAction('Controller@method');
    //     // $this->assertViewHas('name');
    //     // $this->assertViewHas('age', $value);
    //     // $this->assertSessionHas('name');
    //     // $this->assertSessionHas('age', $value);
    // }
    
    // public function testShowQuestionsFindsById()
    // {
    //     $id = 1;
        
    //     $question = new App\Question();
        
    //     $this->mocks['question']
    //         ->shouldReceive('findOrFail')
    //         ->once()
    //         ->with($id)
    //         ->andReturn($question);
        
    //     // dispatch
        
    //     $response = $this->call('GET', 'questions/' . $id);
        
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertViewHas('question', $question);
    // }
    
    public function testStoreWithInvalidParams()
    {
        // $this->mocks['auth'] = Mockery::mock('Illuminate\Auth\AuthManager');
        
        // $this->app->instance('Illuminate\Auth\AuthManager', $this->mocks['auth']);
        
        $response = $this->call('POST', 'questions', array(
            '_token' => csrf_token(),
        ));
        
        $this->assertRedirectedTo('questions');
    }
}



// class QuestionsControllerTest extends TestCase {

//     public function setUp()
//     {
//         // call this first to setup the required auth mocks
//         parent::setUp();
        
//         // this is the questions model for this test case
//         $this->mocks['question']s['question'] = $this->getMockBuilder('App\Question')
//             ->disableOriginalConstructor()
//             ->getMock();
        
//         // and this is the questions() which return the hasMany (for creating, updating etc)
//         // $this->mocks['question']s['authUser']
//         //     ->shouldReceive('questions')
//         //     ->once()
//         //     ->andReturn($this->mocks['question']s['hasMany']);
//     }
    
//     public function tearDown()
//     {
//         Mockery::close();
//     }
    
//     // public function testQuestionIndexGetsLatestQuestions()
//     // {
//     //     $this->mocks['question']s['question']
//     //        ->shouldReceive('latest')
//     //        ->once()
//     //        ->andReturnSelf();
        
//     //     $questions = new Illuminate\Database\Eloquent\Collection;
//     //     $this->mocks['question']s['question']
//     //         ->shouldReceive('get')
//     //         ->once()
//     //         ->andReturn($questions);
        
//     //     $this->app->instance('App\Question', $this->mocks['question']s['question']);
        
//     //     // dispatch
        
//     //     $response = $this->call('GET', 'questions');
        
//     //     $this->assertEquals(200, $response->getStatusCode());
//     //     $this->assertViewHas('questions', $questions);
        
        

//     //     // $this->assertResponseOk();
//     //     // $this->assertViewHas('questions');
//     //     //$this->assertEquals(200, $response->getStatusCode());
//     //     // $this->assertResponseStatus(403);
//     //     // $this->assertRedirectedTo('foo');
//     //     // $this->assertRedirectedToRoute('route.name');
//     //     // $this->assertRedirectedToAction('Controller@method');
//     //     // $this->assertViewHas('name');
//     //     // $this->assertViewHas('age', $value);
//     //     // $this->assertSessionHas('name');
//     //     // $this->assertSessionHas('age', $value);
//     // }
    
//     public function testShowQuestionsFindsById()
//     {
//         $id = 1;
        
//         // $question = new App\Question();
        
//         // $this->mocks['question']s['question']
//         //     ->expects($this->once())
//         //     ->method('findOrFail')
//         //     ->with($id)
//         //     ->willReturn($question);
        
//         // $this->app->instance('App\Question', $this->mocks['question']s['question']);
        
//         // dispatch
        
//         $response = $this->call('GET', 'questions/' . $id);
        
//         $this->assertEquals(200, $response->getStatusCode());
//         $this->assertViewHas('question', $question);
//     }
    
//     // public function testCreateShowsForm()
//     // {
        
//     // }
    
//     // public function testShowQuestionsFindsById()
//     // {
//     //     // dispatch
        
//     //     $response = $this->call('GET', 'questions/' . $id);
        
//     //     $this->assertEquals(200, $response->getStatusCode());
//     //     $this->assertViewHas('question', $question);
//     // }
    
//     public function testStoreWithInvalidParams()
//     {
//         // $this->mocks['question']s['auth']
//         //     ->expects($this->once())
//         //     ->method('user')
//         //     ->willReturn($this->mocks['question']s['authUser']);
        
//         // $this->mocks['question']s['authUser']
//         //     ->expects($this->once())
//         //     ->method('questions')
//         //     ->willReturn($this->mocks['question']s['hasMany']);
        
//         // $this->mocks['question']s['hasMany']
//         //     ->expects($this->once())
//         //     ->method('create')
//         //     ->with(array());
        
//         // // assert that create is called via auth middleware
//         // $this->mocks['question']s['hasMany']
//         //     ->shouldReceive('create')
//         //     ->once()
//         //     ->with();
        
//         // $this->assertRedirectedTo('questions');
//         // $this->assertSessionHas('flash_message');
//     }
    
//     // public function testStoreWithValidParams()
//     // {
        
//     // }
    
//     // public function testDeleteByGetDeosNotCallDelete()
//     // {
        
//     // }
    
//     // public function testDeleteByDeleteDeosCallsDelete()
//     // {
        
//     // }
    
    
    
//     // protected function getInvalidParams()
//     // {
//     //     return array(
//     //         array('', 'content', 'tags'), // empty title
//     //     );
//     // }
// }