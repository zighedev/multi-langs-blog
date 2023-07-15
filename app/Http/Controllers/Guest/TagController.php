<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class TagController extends Controller
{

	
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       
    }
	
    
    public function show($tag_id){
		
		$tag = Tag::findOrFail($tag_id);
		$articles = $tag->articles()->approved()
									->hasBodyInThisLocale()
									->with(['images' => function($q){
										$q->backgroundImage()->first();
									}])->paginate(ARTICLES_PAGINATION_COUNT);
		$tag->makeVisible(['name', 'title', 'description']);							
		return view('guest.tag', compact('tag', 'articles'));
    }
    
    
}
