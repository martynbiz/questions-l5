<?php namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Http\Controllers\Controller;

use App\Question;
use App\Answer;

use Illuminate\Auth\AuthManager;

class AnswersController extends Controller {

	protected $answer;
	protected $auth;
	
	/**
     * 
     */
    public function __construct(AuthManager $auth, Answer $answer)
    {
        // set our controllers model
        $this->answer = $answer;
        $this->auth = $auth;
        
        // apply auth middleware to authenticate all pages.
        $this->middleware('auth');
    }
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(AnswerRequest $request, Question $question)
	{
		$user = $this->auth->user();
		
		// *has this user already answered this question?
		$question = $question->find( $request->get('question_id') );
		if ($user->hasAnswered($question)) {
			return redirect()->to($question->id)->with([
	            'flash_message' => 'You have already given an answer for this question',
	        ]);
		}
		
		// create answer
		$answer = $user->answers()->create( $request->all() );
		
		// 
		return redirect()->to($answer->question_id)->with([
            'flash_message' => 'Thank you for your answer',
        ]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// will throw an exception if not found
        $answer = $this->auth->user()->answers()->findOrFail($id);
        
        // render the view script, or json if ajax request
        return $this->render('answers.edit', compact('answer'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AnswerRequest $request, $id)
	{
		// will throw an exception if not found
        $answer = $this->auth->user()->answers()->findOrFail($id);
        
        // update the answer with the request params
        $answer->update($request->all());
        
        return redirect()->to($answer->question_id)->with([
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
		$answer = $this->auth->user()->answers()->findOrFail($id);
		
		// capture the questionId before we delete
		$questionId = $answer->question_id;
		
		// will throw an exception if not found
        $answer->delete();
        
        return redirect()->to($questionId)->with([
            'flash_message' => 'Question has been updated',
        ]);
	}

}
