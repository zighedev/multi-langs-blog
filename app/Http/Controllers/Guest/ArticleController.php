<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;

class ArticleController extends Controller
{

	
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       
    }
	
    
    public function show($article_id){
		
		$article = Article::select('id', 'image', 'user_id', 'category_id', 'created_at')
							->approved()
							->with(['user' => function($q){
								$q->select('id', 'name');
							}])
							->with(['category' => function($q){
								$q->select('id');
							}])
							->findOrFail($article_id);
		
		$tags = Article::find($article_id)->tags()->get()->makeHidden(['name', 'description']);
		
		$related_articles = Article::select('id', 'image')
									->approved()
									->whereHas('tags', function($q) use($tags){
										$q->whereIn('tag_id', $tags);
									})
									->take(RELATED_ARTICLES_COUNT)
									->get();
					
		$tags = $tags->makeVisible('name');//id, name
		$related_articles = $related_articles->makeHidden('content');// id, image, title, description, image_description
		$comments = $article->comments()->get(); //id, name, comment, created_at
		
        return view('guest.article', compact('article', 'tags', 'related_articles', 'comments'));
    }

    

    
}
