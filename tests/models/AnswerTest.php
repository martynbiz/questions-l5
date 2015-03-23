<?php

use App\Answer;

class AnswerTest extends TestCase
{
    public function testUserBelongsToRelationshipExists()
    {
        $answer = new Answer();
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\BelongsTo', get_class( $answer->user() ));
    }
    
    public function testQuestionBelongsToRelationshipExists()
    {
        $answer = new Answer();
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\BelongsTo', get_class( $answer->question() ));
    }
}