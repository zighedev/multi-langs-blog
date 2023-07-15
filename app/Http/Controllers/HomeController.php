<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

	
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       
    }
	
    
    public function index(){
		
		// show articles/latest - most viewed - recommanded
        return view('home');
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }

    
}
