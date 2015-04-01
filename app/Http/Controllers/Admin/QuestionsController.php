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
     * Index will show approved if any, otherwise
     */
    public function index()
    {
        // get list of all questions
        $questions = $this->question
            ->with('answers')
            ->with('follows')
            ->with('user')
            ->paginate(5);
        
        // get unapproved questions - *mocked
        $total_unapproved = $this->question
            ->take(1) // 1 is enough to display the tab -- why 11????
            ->count();
        
        return view('admin.questions.index', compact('questions', 'total_unapproved'));
    }
    
    /**
     * List of unapproved questions to review (if exist)
     */
    public function approve()
    {
        // get unapproved questions - *mocked
        $questions = $this->question
            ->with('answers')
            ->with('follows')
            ->with('user')
            ->oldest() // approved oldest first
            ->take(5) // allows 5 to display at once (and approve all 5)
            ->get();
        
        return view('admin.questions.approve', compact('questions'));
    }
}