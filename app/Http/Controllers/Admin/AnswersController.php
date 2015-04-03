<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Answer;

use Auth;

class AnswersController extends Controller {
    
	protected $answer;
    
    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }
    
    /**
     * List answers that the user owns
     */
    public function index()
    {
        $answers = $this->answer
            ->with('question')
            ->where('is_approved', '<>', 1) // not approved
            ->paginate(5);
        
        return view('admin.answers.index', compact('answers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // will throw an exception if not found
        $answer = $this->answer->findOrFail($id);
        
        // update the answer with the request params
        $answer->update($request->all());
        
        return redirect()->to('admin/answers')->with([
            'flash_message' => 'Answer has been updated',
        ]);
    }
}