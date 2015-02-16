<?php namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;

use App\Question;

use Auth;
use Request;

class QuestionsController extends Controller {

	protected $question;
    
    public function index(Question $question)
    {
        // var_dump(get_class($question)); exit; // Outputs App\Question when testing too
        
        $questions = $question
            ->latest()
            ->get();
        
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
    
    public function store(QuestionRequest $request)
    {
        $question = new Question($request->all());
        
        Auth::user()->questions()->save($question);
        
        return redirect('questions');
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
