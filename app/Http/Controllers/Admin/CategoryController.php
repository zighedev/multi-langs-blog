<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(isset($_GET['visible'])){
			$categories = Category::visible()->paginate(TABLES_PAGINATION_COUNT);
		}elseif(isset($_GET['invisible'])){
			$categories = Category::invisible()->paginate(TABLES_PAGINATION_COUNT);
		}elseif(isset($_GET['ads'])){
			$categories = Category::adsAllowed()->paginate(TABLES_PAGINATION_COUNT);
		}elseif(isset($_GET['noads'])){
			$categories = Category::adsNotAllowed()->paginate(TABLES_PAGINATION_COUNT);
		}else{
			$categories = Category::paginate(TABLES_PAGINATION_COUNT);
		}
		$categories->through(fn($entity) => $entity->makeVisible(['visibility', 'ads']));
		
		return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		$categories = Category::where('parent', null)->get();
        return view('admin.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request){
		
		$category = Category::create($request->except(['visibility', 'ads']));
		
        if(!$category){
            return redirect()->back()->with(['fail' => __('words.failed')]);
        }
		
		$category->update([
			'visibility' => $request->visibility ? 1 : 0,
			'ads' => $request->ads ? 1 : 0,
		]);
		
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
		$categories = Category::where('parent', null)->where('id', '!=', $id)->get();
		$category = Category::findOrFail($id)->makeVisible(['visibility', 'ads']);
							
        return view('admin.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
		
        $category = Category::find($id);
        if(!$category)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
		$category->update($request->except(['visibility', 'ads']));
		$category->update([
			'visibility' => $request->visibility ? 1 : 0,
			'ads' => $request->ads ? 1 : 0,
		]);
        		
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
		$category = Category::find($id);
		
        if(!$category)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
		$category->delete();
        return redirect()->back()->with(['success' => __('words.success')]);
        
    }
	
	
}
