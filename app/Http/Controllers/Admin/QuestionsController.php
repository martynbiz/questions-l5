<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Question;

use Auth;
use Request;

class QuestionsController extends Controller {
    
	protected $question;
    
    public function __construct(Question $question)
    {
        $this->question = $question;
    }
    
    /**
     * List questions that the user owns
     */
    public function index()
    {
        $questions = $this->question
            ->all();
        
        return view('admin.questions.index', compact('questions'));
    }
}