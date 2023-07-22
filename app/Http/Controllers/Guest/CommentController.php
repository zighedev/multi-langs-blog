<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{

	
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       
    }
	
    
    public function store(CommentRequest $request){ 
		$comment = Comment::create($request->all());
		$data = [];
		
        if($comment){
			$data['success'] = true;
		}else{
			$data['success'] = false;
		}
		
		return $data;
    }

    

    
}
