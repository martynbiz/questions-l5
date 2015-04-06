<?php namespace App\Http\Controllers;

// requests
use App\Http\Requests\QuestionRequest;

// models
use App\Question;
use App\Tag;

use App\Auth\AuthManager;

use App\Services\Points;

use Cache;

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
    
    
    // hometabs
    
    /**
     * Display page of newest questions
     */
    public function index() // newest
    {
        list($newest, $popular, $unanswered) = $this->getHomeQuestions();
        
        // render the view script, or json if ajax request
        return $this->render('questions.index', compact('newest', 'popular', 'unanswered'))->render();
    }
    
    /**
     * Display page of popular questions
     */
    public function popular()
    {
        list($newest, $popular, $unanswered) = $this->getHomeQuestions();
        
        // render the view script, or json if ajax request
        return $this->render('questions.popular', compact('newest', 'popular', 'unanswered'));
    }
    
    /**
     * Display page of unanswered questions
     */
    public function unanswered()
    {
        list($newest, $popular, $unanswered) = $this->getHomeQuestions();
        
        // render the view script, or json if ajax request
        return $this->render('questions.unanswered', compact('newest', 'popular', 'unanswered'));
    }
    
    /**
     * Display page of following questions
     */
    public function following()
    {
        list($newest, $popular, $unanswered) = $this->getHomeQuestions();
        
        // render the view script, or json if ajax request
        return $this->render('questions.following', compact('newest', 'popular', 'unanswered'));
    }
    
    
    // 
    
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
    public function store(AuthManager $auth, QuestionRequest $request, Points $points)
    {
        // save question
        $question = $auth->user()->questions()->create( $request->all() );
        
        // save tags
        if ($request->input('tags')) {
            foreach($request->input('tags') as $tagId) {
                $question->tags()->attach($tagId);
            }
        }
        // award points
        $points->send([
            'login' => $auth->user()->username,
            'site_action' => 'ask',
            'target_type' => 'question',
            'question_id' => $question->id,
        ]);
        
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
    
    
    // private / protected methods
    
    protected function getHomeQuestions()
    {
        // set option to use cache
        $options = array('useCache' => true);
        $question = $this->question;
        $minutes = 5; // minutes to cache
        
        // use cache to store/ retreive
        $newest = Cache::remember('questions_newest', $minutes, function() use ($question, $options) {
            return $question->newest($options);
        });
        
        $popular = Cache::remember('questions_popular', $minutes, function() use ($question, $options) {
            return $question->popular($options);
        });
        
        $unanswered = Cache::remember('questions_unanswered', $minutes, function() use ($question, $options) {
            return $question->unanswered($options);
        });
        
        // return collections of questions
        return array(
            $newest,
            $popular,
            $unanswered,
        );
    }
}
