<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;

use App\Tag;

use Illuminate\Http\Request;

use Illuminate\Auth\AuthManager;

class TagsController extends Controller {

	protected $tag;
    
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tags = $this->tag
            ->with('questions') // so we can use total_questions
            ->orderBy('name') // alphabetical order
            ->paginate(15);
        
        return view('admin.tags.index', compact('tags'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// we need an empty tag for the form
        $tag = new Tag;
        
        return view('admin.tags.create', compact('tag'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TagRequest $request)
	{
		$this->tag->create( $request->all() );
		
		return redirect()->to('admin/tags')->with([
            'flash_message' => 'A new tag has been created',
        ]);
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
        $tag = $this->tag->findOrFail($id);
        
        return view('admin.tags.edit', compact('tag'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(TagRequest $request, $id)
	{
		// will throw an exception if not found
        $tag = $this->tag->findOrFail($id);
        
        // update the question with the request params
        $tag->update($request->all());
        
        return redirect()->to('admin/tags')->with([
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
		$tag = $this->tag->findOrFail($id);
        
        // will throw an exception if not found
        $tag->delete();
        
        return redirect()->to('admin/tags')->with([
            'flash_message' => 'Tag has been deleted',
        ]);
	}

}
