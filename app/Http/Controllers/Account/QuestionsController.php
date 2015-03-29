<?php namespace App\Http\Controllers\Account;

/**
 * This controller is only really used to list all questions
 */

use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;

use App\Question;

use Auth;
use Request;

use Illuminate\Auth\AuthManager;

class QuestionsController extends Controller {
    
	/**
     * Currently authenticated user
     * @var App\User
     */
    protected $user;
    
    public function __construct(AuthManager $auth)
    {
        // set our auth instance
        $this->user = $this->user;
    }
    
    /**
     * List questions that the user owns
     */
    public function index()
    {
        $questions = $this->user->questions()
            ->all();
        
        return view('account.questions.index', compact('questions'));
    }
    
    /**
     * List questions that this user is following
     */
    public function following()
    {
        $questions = $this->user->questions()
            ->following();
        
        return view('account.questions.index', compact('questions'));
    }
}
