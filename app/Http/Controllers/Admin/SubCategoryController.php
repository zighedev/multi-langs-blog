<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Scopes\SubCategoryByLanguage;

class SubCategoryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(isset($_GET['visible'])){
			$subcategories = SubCategory::withoutGlobalScope(SubCategoryByLanguage::class)->visible()->with('category')->paginate(TABLES_PAGINATION_COUNT);
		}elseif(isset($_GET['invisible'])){
			$subcategories = SubCategory::withoutGlobalScope(SubCategoryByLanguage::class)->invisible()->with('category')->paginate(TABLES_PAGINATION_COUNT);
		}else{
		     $subcategories = SubCategory::withoutGlobalScope(SubCategoryByLanguage::class)->with('category')->paginate(TABLES_PAGINATION_COUNT);
		}
		
		$subcategories->each(function($sub){
			if($sub->title_en == null || $sub->title_en == null || $sub->title_en == null){
				$sub->title = 0;
			}else{
				$sub->title = 1;
			}
            if($sub->description_en == null || $sub->description_fr == null || $sub->description_ar == null){
				$sub->description = 0;
			}else{
				$sub->description = 1;
			}
			
			unset($sub->title_en);
			unset($sub->title_fr);
			unset($sub->title_ar);
			unset($sub->description_en);
			unset($sub->description_fr);
			unset($sub->description_ar);
			
        });
		
		$subcategories->makeVisible(['title', 'description', 'visibility']);
		return view('admin.sub_category.index', compact('subcategories')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		
        $categories = Category::all();
        return view('admin.sub_category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request){
        $subcategory = SubCategory::create([
            'name_en' => $request->name_en,
			'name_fr' => $request->name_fr,
			'name_ar' => $request->name_ar,
			'title_en' => $request->title_en,
			'title_fr' => $request->title_fr,
			'title_ar' => $request->title_ar,
			'description_en' => $request->description_en,
			'description_fr' => $request->description_fr,
			'description_ar' => $request->description_ar,
            'visibility' => $request->visibility ? 1 : 0,
			'category_id' => $request->category_id,
        ]);

        if(!$subcategory){
            return redirect()->back()->with(['fail' => __('words.failed')]);
        }
		
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
		$subcategory = SubCategory::withoutGlobalScope(SubCategoryByLanguage::class)
							->findOrFail($id)
							->makeVisible(['visibility', 'category_id'])
							->makeHidden(['created_at', 'updated_at']);
		
		$categories = Category::all();
        $subcategory;
		return view('admin.sub_category.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
		$subcategory = SubCategory::find($id);
		
        if(!$subcategory)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
        $subcategory->update([
            'name_en' => $request->name_en,
			'name_fr' => $request->name_fr,
			'name_ar' => $request->name_ar,
			'title_en' => $request->title_en,
			'title_fr' => $request->title_fr,
			'title_ar' => $request->title_ar,
			'description_en' => $request->description_en,
			'description_fr' => $request->description_fr,
			'description_ar' => $request->description_ar,
            'visibility' => $request->visibility ? 1 : 0,
			'category_id' => $request->category_id,
        ]);
		
        return redirect()->back()->with(['success' => __('words.success'), 'update' => 'yes']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);
		
        if(!$subcategory)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
		$subcategory->delete();
        return redirect()->back()->with(['success' => __('words.success'), 'update' => 'yes']);
    }
	
	
}
