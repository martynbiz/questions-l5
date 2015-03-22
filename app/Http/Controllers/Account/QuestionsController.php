<?php namespace App\Http\Controllers\Account;

use App\Http\Requests\QuestionRequest;
use App\Http\Controllers\Controller;

use App\Question;

use Auth;
use Request;

use Illuminate\Auth\AuthManager;

class QuestionsController extends Controller {
    
	protected $question;
    
    public function __construct(Question $question)
    {
        // this resource requires the auth to login
        $this->middleware('auth');
        
        $this->question = $question;
    }
    
    public function index(AuthManager $auth)
    {
        $questions = $auth->user()->questions()
            ->latest()
            ->get();
        
        return view('account.questions.index', compact('questions'));
    }
    
    public function show(AuthManager $auth, $id)
    {
        $question = $auth->user()->questions()
            ->findOrFail($id);
        
        return view('account.questions.show', compact('question'));
    }
    
    public function create()
    {
        return view('account.questions.create');
    }
    
    public function store(AuthManager $auth, QuestionRequest $request)
    {
        $auth->user()->questions()
            ->create( $request->all() );
        
        return redirect('account.questions')->with([
            'flash_message' => 'A new question has been created',
        ]);
    }
    
    public function edit(AuthManager $auth, $id)
    {
        $question = $auth->user()->questions()
            ->findOrFail($id);
        
        return view('account.questions.edit', compact('question'));
    }
    
    public function update(AuthManager $auth, QuestionRequest $request, $id)
    {
        $question = $auth->user()->questions()
            ->findOrFail($id);
        
        $question->update( $request->all() );
        
        return redirect('account.questions');
    }

}
