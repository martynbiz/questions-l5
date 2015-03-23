<?php

use App\Question;

class QuestionTest extends TestCase
{
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
}