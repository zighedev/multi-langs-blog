<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{

    public function __construct(){
       
    }
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$users = User::select('id', 'name', 'created_at')->writer()->paginate(TABLES_PAGINATION_COUNT);
		
		$users->each(function($user){
            $user->total_articles = $user->articles->count();
        });
		$users->through(fn($entity) => $entity->makeHidden('articles'));
        
		return view('admin.user.index', compact('users'));	
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['fail' => __('words.failed')]);
		
		$user->delete();
        return redirect()->back()->with(['success' => __('words.success')]);
    }

    
}
