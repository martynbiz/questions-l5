<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;

use App\Tag;

use Illuminate\Http\Request;

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
            ->all();
        
        return view('admin.tags.index', compact('tags'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(TagRequest $request)
	{
		return view('admin.tags.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TagRequest $request)
	{
		$this->tag->create($request->all());
		
		return redirect()->to('admin.tags')->with([
            'flash_message' => 'A new tag has been created',
            // 'flash_message_important' => true,
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
        
        return view('admin.tags.edit', compact('tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// will throw an exception if not found
        $tag = $this->tag->findOrFail($id);
        
        // update the question with the request params
        $tag->update($request->all());
        
        return redirect()->to($id)->with([
            'flash_message' => 'Question has been updated',
            // 'flash_message_important' => true,
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
		//
	}

}
