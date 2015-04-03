<?php namespace App\Http\Controllers\Admin;

// requests
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Question;

use Auth;

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
        $total_pending = $this->question
            ->where('is_approved', '<>', 1) // not approved
            ->take(1) // 1 is enough to display the tab -- why 11????
            ->count();
        
        return view('admin.questions.index', compact('questions', 'total_pending'));
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
            ->where('is_approved', '<>', 1) // not approved
            ->oldest() // approved oldest first
            ->paginate(5);
        
        $total_pending = count($questions);
        
        return view('admin.questions.approve', compact('questions', 'total_pending'));
    }
    
    /**
     * Approved action handle
     */
    public function update(Request $request, $id)
    {
        // will throw an exception if not found
        $question = $this->question->findOrFail($id);
        
        // update the question with the request params
        $question->update( $request->all() );
        
        // we only edit is_approved, so redirect back to there
        return redirect()->to('admin/questions/pending')->with([
            'flash_message' => 'Question has been approved',
        ]);
    }
}