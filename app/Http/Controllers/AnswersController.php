<?php namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;

use App\Question;
use App\Answer;

use Illuminate\Auth\AuthManager;

use App\Services\Notify;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnswersController extends Controller {

	protected $answer;
	
	/**
     * 
     */
    public function __construct(Answer $answer)
    {
        // set our controllers model
        $this->answer = $answer;
        
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
	public function store(AuthManager $auth, AnswerRequest $request, Question $question, Notify $notify)
	{
		// Check if this user has answered the question already
		$question = $question->find( $request->get('question_id') );
		if ($auth->user()->hasAnswered($question)) {
			return redirect()->to($question->id)->with([
	            'flash_message' => 'You have already given an answer for this question',
	        ]);
		}
		
		// create answer
		$answer = $auth->user()->answers()->create( $request->all() );
        
        // send notification emails
        $notify->toQuestionOwnerReNewAnswer($answer);
        $notify->toQuestionFollowersReNewAnswer($answer);
		
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
	public function edit(AuthManager $auth, $id)
	{
		// will throw an exception if not found
        $answer = $auth->user()->answers()->findOrFail($id);
        
        // render the view script, or json if ajax request
        return $this->render('answers.edit', compact('answer'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(AuthManager $auth, AnswerRequest $request, $id)
	{
		// will throw an exception if not found
        $answer = $auth->user()->answers()->findOrFail($id);
        
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
	public function destroy(AuthManager $auth, $id)
	{
		// will throw an exception if not found
        $answer = $this->answer->findOrFail($id);
        
        // can this user delete this answer (may be an admin user?)
        if (! $auth->user()->canDelete($answer))
            throw new ModelNotFoundException('You do not have permission to delete this answer');
        
		// capture the questionId before we delete
		$questionId = $answer->question_id;
		
		// delete the answer
        $answer->delete();
        
        return redirect()->to($questionId)->with([
            'flash_message' => 'Answer has been deleted',
        ]);
	}

}
