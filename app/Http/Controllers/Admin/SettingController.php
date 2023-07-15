<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
	
	
    
    public function index(){
			
		return view('admin.settings');
    }
	
	public function update(SettingRequest $request){
		Setting::first()->update($request->all());
		
		return redirect()->back()->with(['success' => __('words.success')]);		
	}

}
