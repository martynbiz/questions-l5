<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
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
    
    public function index()
    {
        $questions = $this->question
            ->latest()
            ->get();
        
        // \Session::flash('flash_message', 'A new question has been created');
        // \Session::flash('flash_message_important', true);
        
        return view('questions.index', compact('questions'));
    }
    
    public function show($id)
    {
        $question = $this->question->findOrFail($id);
        
        return view('questions.show', compact('question'));
    }
    
    public function create()
    {
        return view('questions.create');
    }
    
    public function store(\Illuminate\Auth\AuthManager $auth, QuestionRequest $request)
    {
        // $auth->user()->questions()->create( $request->all() );
        
        return redirect('questions')->with([
            'flash_message' => 'A new question has been created',
        ]);
    }
    
    public function edit($id)
    {
        $question = $this->question->findOrFail($id);
        
        return view('questions.edit', compact('question'));
    }
    
    public function update(QuestionRequest $request, $id)
    {
        $question = $this->question->findOrFail($id);
        
        $question->update($request->all());
        
        return redirect('questions');
    }

}
