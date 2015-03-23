<?php namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;

use App\Question;
use App\Tag;

use Auth;
use Request;

class QuestionsController extends Controller {
    
	protected $question;
    
    /**
     * 
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }
    
    /**
     * 
     */
    public function index() // newest
    {
        $questions = $this->question
            ->with('answers')
            ->with('tags')
            ->with('user')
            ->with('follows')
            ->latest()
            ->get();
        
        return view('questions.index', compact('questions'));
    }
    
    /**
     * 
     */
    public function popular()
    {
        $questions = $this->question
            ->latest()
            ->get();
        
        return view('questions.index', compact('questions'));
    }
    
    /**
     * 
     */
    public function unanswered()
    {
        $questions = $this->question
            ->latest()
            ->get();
        
        return view('questions.index', compact('questions'));
    }
    
    /**
     * 
     */
    public function show($id)
    {
        $question = $this->question
            ->findOrFail($id);
        
        return view('questions.show', compact('question'));
    }
    
    /**
     * 
     */
    public function create(Tag $tag)
    {
        $tags = $tag->all();
        
        return view('questions.create', compact('tags'));
    }
    
    /**
     * 
     */
    public function store(\Illuminate\Auth\AuthManager $auth, QuestionRequest $request)
    {
        $auth->user()->questions()
            ->create( $request->all() );
        
        return redirect()->route('index')->with([
            'flash_message' => 'A new question has been created',
            // 'flash_message_important' => true,

        ]);
    }
    
    /**
     * 
     */
    public function edit($id)
    {
        $question = $this->question
            ->findOrFail($id);
        
        return view('questions.edit', compact('question'));
    }
    
    /**
     * 
     */
    public function update(QuestionRequest $request, $id)
    {
        $question = $this->question
            ->findOrFail($id);
        
        $question->update($request->all());
        
        return redirect()->route('show', ['id' => $id])->with([
            'flash_message' => 'Question has been updated',
            // 'flash_message_important' => true,
        ]);
    }
}
