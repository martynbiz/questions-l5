<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

use App\User;

use Illuminate\Http\Request;

use Illuminate\Auth\AuthManager;

class UsersController extends Controller {

	protected $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->paginate(15);
        
        return view('admin.users.index', compact('users'));
	}
    
    /**
     * 
     */
    public function show($id)
    {
        // will throw an exception if not found
        $user = $this->user
            ->with('questions')
            ->with('answers')
            ->findOrFail($id);
        
        // render the view script, or json if ajax request
        return $this->render('admin.users.show', compact('user'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = $this->user->findOrFail($id);
        
        var_dump($id); exit;
        
        // will throw an exception if not found
        $user->delete();
        
        return redirect()->to('admin/users')->with([
            'flash_message' => 'User has been deleted',
        ]);
	}

}
