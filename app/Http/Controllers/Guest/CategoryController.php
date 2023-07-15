<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

	
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       
    }
	
    
    public function index(){
		$categories = Category::visible()->isParent()->whereHas('children', function($q){
			$q->visible()->whereHas('articles', function($q){
				$q->approved();
			});
		});	
		$categories = $categories->with(['children' => function($q){
			$q->visible()->whereHas('articles', function($q){
				$q->approved();
			});
		}])->get();
		
		return $categories;	
    }
	
	public function show($id){
		return $id;
	}
    
    
}
