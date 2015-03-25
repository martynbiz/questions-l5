<?php namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;

use App\Question;
use App\Tag;

use Illuminate\Auth\AuthManager;

// use Auth;
use Request;

class QuestionsController extends Controller {
    
	protected $question;
    
    /**
     * 
     */
    public function __construct(Question $question)
    {
        // set our controllers model
        $this->question = $question;
        
        // apply auth middleware to authenticate certain pages. All other
        // page are public.
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update']]);
    }
    
    /**
     * Display page of newest questions
     */
    public function index() // newest
    {
        $questions = $this->question->newest();
        
        return view('questions.index', compact('questions'));
    }
    
    /**
     * Display page of popular questions
     */
    public function popular()
    {
        $questions = $this->question->popular();
        
        return view('questions.index', compact('questions'));
    }
    
    /**
     * Display page of unanswered questions
     */
    public function unanswered()
    {
        $questions = $this->question->unanswered();
        
        return view('questions.index', compact('questions'));
    }
    
    /**
     * 
     */
    public function show($id)
    {
        // will throw an exception if not found
        $question = $this->question->findOrFail($id);
        
        return view('questions.show', compact('question'));
    }
    
    /**
     * 
     */
    public function create(Tag $tag)
    {
        // get the tags so that we can display tag list
        $tags = $tag->all();
        
        return view('questions.create', compact('tags'));
    }
    
    /**
     * 
     */
    public function store(AuthManager $auth, QuestionRequest $request)
    {
        // this will create the question for this user
        $auth->user()->questions()->create( $request->all() );
        
        return redirect()->to('/')->with([
            'flash_message' => 'A new question has been created',
            // 'flash_message_important' => true,

        ]);
    }
    
    /**
     * 
     */
    public function edit(AuthManager $auth, $id)
    {
        // will throw an exception if not found
        $question = $auth->user()->questions()->findOrFail($id);
        
        return view('questions.edit', compact('question'));
    }
    
    /**
     * 
     */
    public function update(AuthManager $auth, QuestionRequest $request, $id)
    {
        // will throw an exception if not found
        $question = $auth->user()->questions()->findOrFail($id);
        
        // update the question with the request params
        $question->update($request->all());
        
        return redirect()->to($id)->with([
            'flash_message' => 'Question has been updated',
            // 'flash_message_important' => true,
        ]);
    }
}
