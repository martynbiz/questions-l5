<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Answer;

use Auth;
use Request;

class AnswersController extends Controller {
    
	protected $answer;
    
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }
    
    /**
     * List answers that the user owns
     */
    public function index()
    {
        $answers = $this->answer
            ->with('question')
            // ->with('votes') // we need to change votes to answer_id
            ->paginate(5);
        
        return view('admin.answers.index', compact('answers'));
    }
}