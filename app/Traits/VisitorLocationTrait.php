<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

trait VisitorLocationTrait{

    public function setVisitorUrl(Request $request, $locale){
    
		$urlWithoutPath = str_replace($request->path(), '', $request->url());
		$params = explode('/', $request->path());
		if (count($params) > 0) {
			$params[0] = $locale;
			$newPath = implode('/', $params);
			if(empty(http_build_query($request->query())))
				return $urlWithoutPath . $newPath;
			return $urlWithoutPath . $newPath . '?' . http_build_query($request->query());
		}
			
		return $urlWithoutPath;
    } 
	
	public function getVisitorLocale(){
		if($position = Location::get()){
			if($this->frenchLocale(strtolower($position->countryCode)))
				return 'fr';
			if($this->arabicLocale(strtolower($position->countryCode)))
				return 'ar';
		}
		return 'en';
	}
	
	private function frenchLocale($countryCode){
		$fr_codes = array(
					'rw', 'cd', 'dj', 'cf', 'sc', 'bi', 'km', 'mg', 'tf', 'vu', 
					'nc', 'cm', 'sn', 'cg', 'ci', 'gq', 'bf', 'tg', 'bj', 'ga', 
					'gn', 'td', 'ne', 'ml', 'ch', 'be', 'lu', 'mc', 'fr', 'gf', 
					'pm', 'mq', 'mf', 'bl', 'ht', 'pf', 'wf', 'ca'
					);
					
		return in_array($countryCode, $fr_codes);
	}
	
	private function arabicLocale($countryCode){
		$ar_codes = array(
					'so', 'ye', 'iq', 'sa', 'sy', 'jo', 'lb', 
					'kw', 'om', 'qa', 'bh', 'ae', 'eg', 'sd', 
					'ly', 'mr', 'tn', 'ma', 'dz', 'ps', 'ss'
					);
					
		return in_array($countryCode, $ar_codes);
	}
	    

}