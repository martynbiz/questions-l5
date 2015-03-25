<?php

use App\Question;
use App\Tag;
use Illuminate\Database\Eloquent\Collection;

// use Illuminate\Support\Facades\Auth;

class QuestionsControllerTest extends TestCase {

    protected $mocks = [];
    
    public function setUp()
    {
        parent::setUp();
        
        // mock Question
        $this->mocks['Question'] = Mockery::mock('App\Question');
        $this->app->instance('App\Question', $this->mocks['Question']);
        
        Session::start();
    }
    
    public function tearDown()
    {
        Mockery::close();
    }
    
    public function testIndexRouteFetchesNewestQuestions()
    {   
        $questions = new Collection;
        $this->mocks['Question']
            ->shouldReceive('newest')
            ->once()
            ->andReturn($questions);
        
        $response = $this->call('GET', '');
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('questions', $questions);
    }
    
    public function testPopularRouteFetchesPopularQuestions()
    {   
        $questions = new Collection;
        $this->mocks['Question']
            ->shouldReceive('popular')
            ->once()
            ->andReturn($questions);
        
        $response = $this->call('GET', 'popular');
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('questions', $questions);
    }
    
    public function testUnansweredRouteFetchesUnansweredQuestions()
    {   
        $questions = new Collection;
        $this->mocks['Question']
            ->shouldReceive('unanswered')
            ->once()
            ->andReturn($questions);
        
        $response = $this->call('GET', 'unanswered');
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('questions', $questions);
    }
    
    public function testShowRouteFetchesQuestionWithValidId()
    {   
        $id = 1;
        $question = new Question;
        $this->mocks['Question']
            ->shouldReceive('findOrFail')
            ->with($id)
            ->once()
            ->andReturn($question);
        
        $response = $this->call('GET', $id);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('question', $question);
    }
    
    // public function testPostQuestionThrowsExceptionWhenTokenIsMissing()
    // {
        
    // }
    
    // public function testPostQuestionWhenAuthenticated()
    // {   
    //     Auth::shouldReceive('check')->once()->andReturn(true);
        
    //     $response = $this->call('POST', 'questions', array(
    //         'title' => 'Test question',
    //         '_token' => csrf_token(),
    //     ));
        
    //     // $this->assertEquals(200, $response->getStatusCode());
    // }
    
    // public function testQuestionIndexGetsLatestQuestions()
    // {
    //     $this->mocks['Question']
    //        ->shouldReceive('latest')
    //        ->once()
    //        ->andReturnSelf();
        
    //     $questions = new Collection;
    //     $this->mocks['Question']
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
        
    //     $this->mocks['Question']
    //         ->shouldReceive('findOrFail')
    //         ->once()
    //         ->with($id)
    //         ->andReturn($question);
        
    //     // dispatch
        
    //     $response = $this->call('GET', 'questions/' . $id);
        
    //     $this->assertEquals(200, $response->getStatusCode());
    //     $this->assertViewHas('question', $question);
    // }
    
    // public function testStoreWithInvalidParams()
    // {
    //     // $this->mocks['Auth'] = Mockery::mock('Illuminate\Auth\AuthManager');
        
    //     // $this->app->instance('Illuminate\Auth\AuthManager', $this->mocks['Auth']);
        
    //     $response = $this->call('POST', 'questions', array(
    //         '_token' => csrf_token(),
    //     ));
        
    //     $this->assertRedirectedTo('questions');
    // }
}



// class QuestionsControllerTest extends TestCase {

//     public function setUp()
//     {
//         // call this first to setup the required auth mocks
//         parent::setUp();
        
//         // this is the questions model for this test case
//         $this->mocks['Question']s['Question'] = $this->getMockBuilder('App\Question')
//             ->disableOriginalConstructor()
//             ->getMock();
        
//         // and this is the questions() which return the hasMany (for creating, updating etc)
//         // $this->mocks['Question']s['authUser']
//         //     ->shouldReceive('questions')
//         //     ->once()
//         //     ->andReturn($this->mocks['Question']s['hasMany']);
//     }
    
//     public function tearDown()
//     {
//         Mockery::close();
//     }
    
//     // public function testQuestionIndexGetsLatestQuestions()
//     // {
//     //     $this->mocks['Question']s['Question']
//     //        ->shouldReceive('latest')
//     //        ->once()
//     //        ->andReturnSelf();
        
//     //     $questions = new Collection;
//     //     $this->mocks['Question']s['Question']
//     //         ->shouldReceive('get')
//     //         ->once()
//     //         ->andReturn($questions);
        
//     //     $this->app->instance('App\Question', $this->mocks['Question']s['Question']);
        
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
        
//         // $this->mocks['Question']s['Question']
//         //     ->expects($this->once())
//         //     ->method('findOrFail')
//         //     ->with($id)
//         //     ->willReturn($question);
        
//         // $this->app->instance('App\Question', $this->mocks['Question']s['Question']);
        
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
//         // $this->mocks['Question']s['Auth']
//         //     ->expects($this->once())
//         //     ->method('user')
//         //     ->willReturn($this->mocks['Question']s['authUser']);
        
//         // $this->mocks['Question']s['authUser']
//         //     ->expects($this->once())
//         //     ->method('questions')
//         //     ->willReturn($this->mocks['Question']s['hasMany']);
        
//         // $this->mocks['Question']s['hasMany']
//         //     ->expects($this->once())
//         //     ->method('create')
//         //     ->with(array());
        
//         // // assert that create is called via auth middleware
//         // $this->mocks['Question']s['hasMany']
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