<?php

use App\User;
use App\Question;
use App\Answer;

class UserTest extends TestCase
{
    // two Users to test with - an owner of the question/ answer; and a non owner
    protected $userOwner;
    protected $userNotOwner;
    
    // two items to test with - a question and an answer (belonging to userOwner)
    protected $question;
    protected $answer;
    
    public function setUp()
    {
        parent::setUp();
        
        // this User does not own the question/answer
        $this->userOwner = new User();
        $this->userOwner->id = 1;
        
        // this User does not own the question/answer
        $this->userNotOwner = new User();
        $this->userNotOwner->id = 999;
        
        $this->question = new Question();
        $this->question->user_id = 1;
        
        $this->answer = new Answer();
        $this->answer->user_id = 1;
    }
    
    // relationships
    
    /**
     * 
     */
    public function testQuestionsRelationshipReturnsHasMany()
    {
        $user = new User;
        
        $questions = $user->questions();
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\HasMany', get_class($questions));
        $this->assertEquals('App\Question', get_class($questions->getRelated()));
    }
    
    /**
     * 
     */
    public function testAnswersRelationshipReturnsHasMany()
    {
        $user = new User;
        
        $answers = $user->answers();
        
        $this->assertEquals('Illuminate\Database\Eloquent\Relations\HasMany', get_class($answers));
        $this->assertEquals('App\Answer', get_class($answers->getRelated()));
    }
    
    
    // isOwnerOf
    
    /**
     * @dataProvider getUserRoles
     */
    public function testIsOwnerOf()
    {
        // owner
        $this->assertTrue($this->userOwner->isOwnerOf($this->question));
        $this->assertTrue($this->userOwner->isOwnerOf($this->answer));
        
        // not owner
        $this->assertFalse($this->userNotOwner->isOwnerOf($this->question));
        $this->assertFalse($this->userNotOwner->isOwnerOf($this->answer));
    }
    
    
    // canUpdate
    
    /**
     * 
     */
    public function testCanUpdate()
    {
        // owner
        $this->assertTrue($this->userOwner->canUpdate($this->question));
        $this->assertTrue($this->userOwner->canUpdate($this->answer));
        
        // not owner
        $this->assertFalse($this->userNotOwner->canUpdate($this->question));
        $this->assertFalse($this->userNotOwner->canUpdate($this->answer));
    }
    
    /**
     * @dataProvider getUserRoles
     */
    public function testCanUpdateWhenAdminOnly($role)
    {
        // create a User for this $role
        $user = new User();
        $user->role = $role;
        
        $this->assertEquals(($role == 'admin'), $user->canUpdate($this->question));
    }
    
    
    // canDelete
    
    /**
     * 
     */
    public function testCanDelete()
    {
        // owner
        $this->assertTrue($this->userOwner->canUpdate($this->question));
        $this->assertTrue($this->userOwner->canUpdate($this->answer));
        
        // not owner
        $this->assertFalse($this->userNotOwner->canUpdate($this->question));
        $this->assertFalse($this->userNotOwner->canUpdate($this->answer));
    }
    
    /**
     * @dataProvider getUserRoles
     */
    public function testCanDeleteWhenAdminOnly($role)
    {
        // create a User for this $role
        $user = new User();
        $user->role = $role;
        
        $this->assertEquals(($role == 'admin'), $user->canDelete($this->question));
    }
    
    
    
    // HasAnswered
    
    /**
     * 
     */
    public function testHasAnsweredWhenUserHasAnswered()
    {
        // this is the user that is answering
        $user = new User();
        $user->id = 1;
        
        // this is an answer of the questions answers
        $answer = new Answer;
        $answer->user_id = 1;
        
        // mock the questions answers to contain the answer
        $question = new Question();
        $question->answers = array($answer);
        
        $this->assertTrue($user->hasAnswered($question));
    }
    
    /**
     * 
     */
    public function testHasAnsweredWhenUserHasNotAnswered()
    {
        // this is the user that is answering
        $user = new User();
        $user->id = 1;
        
        // this is an answer of the questions answers
        $answer = new Answer;
        $answer->user_id = 999; // different
        
        // mock the questions answers to contain the answer
        $question = new Question();
        $question->answers = array($answer);
        
        $this->assertFalse($user->hasAnswered($question));
    }
    
    
    
    
    // acl methods
    
    /**
     * @dataProvider getUserRoles
     */
    public function testIsAdminWithAdminData($role)
    {
        $user = new User();
        $user->role = $role;
        
        $this->assertEquals(($role == 'admin'), $user->isAdmin());
    }
    
    /**
     * @dataProvider getUserRoles
     */
    public function testIsAnswererWithAnswererData($role)
    {
        $user = new User();
        $user->role = $role;
        
        $this->assertEquals(($role == 'answerer'), $user->isAnswerer());
    }
    
    /**
     * @dataProvider getUserRoles
     */
    public function testIsSubscriberWithSubscriberData($role)
    {
        $user = new User();
        $user->role = $role;
        
        $this->assertEquals(($role == 'subscriber'), $user->isSubscriber());
    }
    
    
    
    
    // data providers
    
    /**
     * This the test data for using against canUpdate (which should only
     * be true for 'admin' users)
     */
    public function getUserRoles()
    {
        return array(
            array('subscriber'),
            array('answerer'),
            array('admin'),
        );
    }
}