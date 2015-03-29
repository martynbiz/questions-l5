<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

// requests
use App\Http\Requests\QuestionRequest;

// models
use App\Question;
use App\Tag;

use Illuminate\Auth\AuthManager;

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
        
        // render the view script, or json if ajax request
        return $this->render('questions.index', compact('questions'));
    }
    
    /**
     * Display page of popular questions
     */
    public function popular()
    {
        $questions = $this->question->popular();
        
        // render the view script, or json if ajax request
        return $this->render('questions.index', compact('questions'));
    }
    
    /**
     * Display page of unanswered questions
     */
    public function unanswered()
    {
        $questions = $this->question->unanswered();
        
        // render the view script, or json if ajax request
        return $this->render('questions.index', compact('questions'));
    }
    
    /**
     * 
     */
    public function show($id)
    {
        // will throw an exception if not found
        $question = $this->question
            ->with('answers')
            ->with('tags')
            ->with('user')
            ->findOrFail($id);
        
        // render the view script, or json if ajax request
        return $this->render('questions.show', compact('question'));
    }
    
    /**
     * 
     */
    public function create(Tag $tag)
    {
        // get the tags so that we can display tag list
        $tags = $tag->all();
        
        // we need an empty question for the form
        $question = new Question;
        
        // render the view script, or json if ajax request
        return $this->render('questions.create', compact('question', 'tags'));
    }
    
    /**
     * 
     */
    public function store(AuthManager $auth, QuestionRequest $request)
    {
        // save question
        $question = $auth->user()->questions()->create( $request->all() );
        
        // save tags
        foreach($request->input('tags') as $tagId) {
            $question->tags()->attach($tagId);
        }
        
        // *award points
        
        // redirect
        return redirect()->to('/')->with([
            'flash_message' => 'A new question has been created',
        ]);
    }
    
    /**
     * 
     */
    public function edit(AuthManager $auth, Tag $tag, $id)
    {
        // will throw an exception if not found
        $question = $auth->user()->questions()->findOrFail($id);
        
        // get the tags so that we can display tag list
        $tags = $tag->all();
        
        // render the view script, or json if ajax request
        return $this->render('questions.edit', compact('question', 'tags'));
    }
    
    /**
     * 
     */
    public function update(AuthManager $auth, QuestionRequest $request, $id)
    {
        // will throw an exception if not found
        $question = $auth->user()->questions()->findOrFail($id);
        
        // update the question with the request params
        $question->update( $request->all() );
        
        // save tags
        $question->tags()->detach();
        foreach($request->input('tags') as $tagId) {
            $question->tags()->attach($tagId);
        }
        
        return redirect()->to($id)->with([
            'flash_message' => 'Question has been updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $question = $this->question->findOrFail($id);
        
        // will throw an exception if not found
        $question->delete();
        
        return redirect()->to('/')->with([
            'flash_message' => 'Question has been deleted',
        ]);
    }
}
