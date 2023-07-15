<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	
    
    public function index(){
			
		if(Auth::user()->role == 'writer'){
			$articles = array(
			'total'				=> Article::where('user_id', Auth::user()->id)->count(),
			'watched'			=> Article::where('user_id', Auth::user()->id)->watched()->count(),
			'approved'			=> Article::where('user_id', Auth::user()->id)->approved()->count(),
			'notApproved' 		=> Article::where('user_id', Auth::user()->id)->notApproved()->count(),
			'notBeenWatched' 	=> Article::where('user_id', Auth::user()->id)->notBeenWatched()->count()
			);
			
			return view('admin.dashboard', compact('articles'));
		}
			
		$categories = array(
		'total'			=> Category::count(),
		'visible'		=> Category::visible()->count(),
		'invisible'		=> Category::invisible()->count(),
		'adsAllowed'	=> Category::adsAllowed()->count(),
		'adsNotAllowed'	=> Category::adsNotAllowed()->count()
		);
	
		$articles = array(
		'total'				=> Article::count(),
		'watched'			=> Article::watched()->count(),
		'approved'			=> Article::approved()->count(),
		'notApproved' 		=> Article::notApproved()->count(),
		'notBeenWatched' 	=> Article::notBeenWatched()->count()
		);
		
		$tags = array(
		'total'	=> Tag::count(),
		);
		
		$users = array(
		'total'	=> User::writer()->count()
		);
		
		$comments = array(
		'total'				=> Comment::count(),
		'hasEmail'			=> Comment::hasEmail()->count(),
		'doesntHaveEmail' 	=> Comment::doesntHaveEmail()->count()
		);
		
		return view('admin.dashboard', compact('categories', 'articles', 'tags', 'users', 'comments'));
    }

}
