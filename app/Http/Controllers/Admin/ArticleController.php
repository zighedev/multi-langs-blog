<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Traits\ImageTrait;

class ArticleController extends Controller
{

	use ImageTrait;
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$this->authorize('viewAny', Article::class);

		if(isset($_GET['me'])){
			$articles = Article::where('user_id', auth()->user()->id);
		}elseif(isset($_GET['category'])){
			$articles = Article::where('category_id', $_GET['category']);
		}elseif(isset($_GET['approved'])){
			$articles = Article::approved();
		}elseif(isset($_GET['notapproved'])){
			$articles = Article::notApproved();
		}elseif(isset($_GET['watched'])){
			$articles = Article::watched();
		}elseif(isset($_GET['notbeenwatched'])){
			$articles = Article::notBeenWatched();
		}else{
			$articles = Article::where('id', '!=', 0);
		}
		
		if (auth()->user()->role === 'admin'){
			$articles = $articles->with('category')->with(['user' => function($q){
				$q->select('id', 'name');
			}])->paginate(TABLES_PAGINATION_COUNT);
		}
		
		if (auth()->user()->role === 'writer'){
			$articles = Article::where('user_id', auth()->user()->id)->with('category')->paginate(TABLES_PAGINATION_COUNT);
		}
		
		$articles->makeHidden([
			'image', 
			'views', 
			'content', 
			'description', 
			'user_id', 
			'category_id', 
			'image_description',
			'updated_at', 
			'deleted_at'
		]);

		return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		
		$this->authorize('create', Article::class);
		
		if(isset($_GET['previous'])){
            if($_GET['previous'] == 1){
				session()->forget('step2');
				$categories = Category::visible()->isParent()->whereHas('children')->get();
				return view('admin.article.create-step-1', compact('categories'));
			}      
            if($_GET['previous'] == 2){
				session()->forget('step3');
				$parent = Category::find(session()->get('step1')['parent']);
				$categories = Category::find($parent->id)->children()->get();
				return view('admin.article.create-step-2', compact('parent', 'categories'));
			} 
			if($_GET['previous'] == 3){
				session()->forget('step4');
				return view('admin.article.create-step-3');
			} 
			if($_GET['previous'] == 4){
				session()->forget('step5');
				return view('admin.article.create-step-4');
			}
			if($_GET['previous'] == 5){
				session()->forget('step6');
				$tags = Tag::all();
				return view('admin.article.create-step-5', compact('tags'));
			}
        }
		
		return $this->stepRedirect();	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */	
    public function store(ArticleRequest $request){
		
		$this->authorize('create', Article::class);
		$step = $request->step;
		
		if($step == 1){
			session()->put('step1', $request->all());
            return redirect()->route('admin.articles.create');
        }
        if($step == 2){
			session()->put('step2', $request->all());
            return redirect()->route('admin.articles.create');
        }
		if($step == 3){
            session()->put('step3', $request->all());
			return redirect()->route('admin.articles.create');
        }
		if($step == 4){
            session()->put('step4', $request->all());
			return redirect()->route('admin.articles.create');
        }
		if($step == 5){
            session()->put('step5', $request->all());
			return redirect()->route('admin.articles.create');
        }
		if($step == 6){
			
			$data = array_merge(session()->get('step1'), session()->get('step2'), session()->get('step3'));					
			unset($data['_token'], $data['step']);

			$article = Article::create($data);
			if(!$article){
				$this->deleteSteps();
				return redirect()->back()->with(['fail' => __('words.failed')]);
			}else{
				$article->update(['user_id' => auth()->user()->id, 'approval' => auth()->user()->role === 'admin' ? 1 : 0]);
				$article->update(session()->get('step4'));
				
				if(isset(session()->get('step5')['tags']))
					$article->tags()->syncWithoutDetaching(session()->get('step5')['tags']);
				
				if($request->hasFile('image')){
					$fileName = $this->saveImage($request->file('image'));
					$article->update(['image' => $fileName]);
					$article->update($request->except(['_token', 'step', 'image']));
				}
				$this->deleteSteps();
				return redirect()->back()->with(['success' => __('words.success')]);
			}
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$article = Article::findOrFail($id);
		$user = auth()->user();
		$this->authorize('view', $article, $user);

        return view('admin.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$article = Article::findOrFail($id);
		$user = auth()->user();
		$this->authorize('update', $article, $user);
		return $article;
		return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
		$this->authorize('update', Article::class);
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$article = Article::find($id);	
		$user = auth()->user();
		
        if(!$article)
            return redirect()->back()->with(['fail' => __('words.failed')]);
	    
		$this->authorize('delete', $article, $user);
		$article->delete();
		
        return redirect()->back()->with(['success' => __('words.success')]);
    }
	

	private function stepRedirect(){
		
		if(!session()->has('step1')){
			$categories = Category::visible()->isParent()->whereHas('children')->get();
			return view('admin.article.create-step-1', compact('categories'));
		}
			
		if(!session()->has('step2')){
			$parent = Category::find(session()->get('step1')['parent']);
			$categories = Category::find($parent->id)->children()->get();
			return view('admin.article.create-step-2', compact('parent', 'categories'));
		}
		
		if(!session()->has('step3'))
			return view('admin.article.create-step-3');
		
		if(!session()->has('step4'))
			return view('admin.article.create-step-4');
		
		if(!session()->has('step5')){
			$tags = Tag::all();
			return view('admin.article.create-step-5', compact('tags'));
		}
		
		if(!session()->has('step6'))
			return view('admin.article.create-step-6');
	}
	
	private function deleteSteps(){
        session()->forget('step1');
        session()->forget('step2');
        session()->forget('step3');
		session()->forget('step4');
        session()->forget('step5');
		session()->forget('step6');
    }
	
	
}
