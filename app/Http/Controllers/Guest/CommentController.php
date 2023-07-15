<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
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
        return 'success';
    }

    

    
}
