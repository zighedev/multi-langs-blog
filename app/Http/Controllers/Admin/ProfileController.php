<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Traits\VisitorLocationTrait;

class ProfileController extends Controller
{
	
	use VisitorLocationTrait;
	
    public function __construct(){
       
    }
	

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {				
		$user = User::findOrFail(Auth::user()->id)->update($request->all());
		
		return redirect()->back()->with(['success' => __('words.success')]);	
    }

    
}
