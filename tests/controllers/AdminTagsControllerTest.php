<?php

use App\Question;
use App\Tag;
use Illuminate\Database\Eloquent\Collection;

// use Illuminate\Support\Facades\Auth;

class AdminTagsControllerTest extends TestCase {

    public function setUp()
    {
        parent::setUp();
        
        // mock Tag
        $this->mocks['Tag'] = Mockery::mock('App\Tag');
        $this->app->instance('App\Tag', $this->mocks['Tag']);
        
        Session::start();
    }
    
    public function tearDown()
    {
        Mockery::close();
    }
    
    
    // conveneince routes
    
    public function testIndexRoute()
    {   
        $tags = new Collection;
        
        $this->markTestIncomplete('Need to mock the auth.admin middleware');
        
        // check it is attaching questions for eager loading
        $this->mocks['Tag']
            ->shouldReceive('with')
            ->with('questions')
            ->once()
            ->andReturnSelf();
        
        // should be in alphabetical order
        $this->mocks['Tag']
            ->shouldReceive('orderBy')
            ->with('name')
            ->once()
            ->andReturnSelf();
        
        // mock get() to return mock Collection
        $this->mocks['Tag']
            ->shouldReceive('get')
            ->once()
            ->andReturn($tags);
        
        $response = $this->call('GET', 'admin/tags');
        
        $this->assertResponseStatus(200); // status ok?
        $this->assertViewHas('tags', $tags); // assert tags is passed to view
    }
}