<?php namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Http\Controllers\Controller;

use App\Answer;

use Illuminate\Auth\AuthManager;

class AnswersController extends Controller {

	/**
     * 
     */
    public function __construct(Answer $answer)
    {
        // set our controllers model
        $this->answer = $answer;
        
        // apply auth middleware to authenticate certain pages. All other
        // page are public.
        // $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update']]);
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
	public function store(AuthManager $auth, AnswerRequest $request)
	{
		$question = $auth->user()->answers()->create( $request->all() );
		
		return redirect()->to($question->id)->with([
            'flash_message' => 'Thank you for your answer',
            // 'flash_message_important' => true,
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
