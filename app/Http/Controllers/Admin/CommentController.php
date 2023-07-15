<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(isset($_GET['hasemail'])){
			$comments = Comment::hasEmail()->with('article')->paginate(TABLES_PAGINATION_COUNT);
		}elseif(isset($_GET['doesnthaveemail'])){
			$comments = Comment::doesntHaveEmail()->with('article')->paginate(TABLES_PAGINATION_COUNT);
		}else{
			$comments = Comment::with('article')->paginate(TABLES_PAGINATION_COUNT);
		}
        
		$comments->through(fn($entity) => $entity->makeHidden('article_id'));
		return view('admin.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return 'send mail to: '.$_GET['email'];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request){
        
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
        abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(!$comment)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
		$comment->delete();
        return redirect()->back()->with(['success' => __('words.success')]);
    }
	
	
}
