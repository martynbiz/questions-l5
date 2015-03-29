<?php

use App\Question;
use Illuminate\Database\Eloquent\Collection;

class QuestionTest extends TestCase
{
    // tets relationships
    
    public function testUserBelongsToRelationshipExists()
    {
        $question = new Question;
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\BelongsTo', get_class( $question->user() ));
    }
    
    public function testAnswersHasManyRelationshipExists()
    {
        $question = new Question;
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\HasMany', get_class( $question->answers() ));
    }
    
    public function testTagsBelongsToManyRelationshipExists()
    {
        $question = new Question;
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\BelongsToMany', get_class( $question->tags() ));
    }
    
    
    // test query scopes
    
    public function testNewestWhenCacheEmpty()
    {
        // the object to test
        $question = new Question;
        
        // mock the Cache
        
        // $this->markTestIncomplete('Need to mock the Cache');
        
        
        // create a mock $query to pass into scope* method
        $this->mocks['query'] = Mockery::mock('Illuminate\Database\Eloquent\Builder');
        
        // ensure that it eager loads answers
        $this->mocks['query']
            ->shouldReceive('with')
            ->with('answers')
            ->once()
            ->andReturnSelf();
        
        // ensure that it eager loads tags
        $this->mocks['query']
            ->shouldReceive('with')
            ->with('tags')
            ->once()
            ->andReturnSelf();
        
        // ensure that it eager loads user
        $this->mocks['query']
            ->shouldReceive('with')
            ->with('user')
            ->once()
            ->andReturnSelf();
        
        // ensure that it eager loads follows
        $this->mocks['query']
            ->shouldReceive('with')
            ->with('follows')
            ->once()
            ->andReturnSelf();
        
        // ensure that it orders by latest
        $this->mocks['query']
            ->shouldReceive('latest')
            ->once()
            ->andReturnSelf();
        
        // finally, it should return a Collection from get()
        $questions = new Collection;
        $this->mocks['query']
            ->shouldReceive('get')
            ->once()
            ->andReturn($questions);
        
        $result = $question->scopeNewest($this->mocks['query']);
        
        $this->assertEquals($questions, $result);
    }
}