<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{

    public function __construct(){
       
    }
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$tags = Tag::paginate(TABLES_PAGINATION_COUNT);
		
        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request){
				
		$tag = Tag::create($request->all());

        if(!$tag){
            return redirect()->back()->with(['fail' => __('words.failed')]);
        }
		
        return redirect()->back()->with(['success' => __('words.success')]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
		
		return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $tag = Tag::find($id);
        if(!$tag)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
        $tag->update($request->all());
		
        return redirect()->back()->with(['success' => __('words.success')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if(!$tag)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
		$tag->delete();
        return redirect()->back()->with(['success' => __('words.success')]);
    }

    
}
