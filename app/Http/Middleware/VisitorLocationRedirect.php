<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Traits\VisitorLocationTrait;

class VisitorLocationRedirect
{
	
	use VisitorLocationTrait;
	
	
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
				
		if(auth()->check()){
			$memberLocale = Session()->get('memberLocale');
			if($memberLocale && auth()->user()->locale == null){
				return $next($request);
			}
			if(!$memberLocale || (auth()->user()->locale != $memberLocale) ){
				$memberLocale = auth()->user()->locale ?? $this->getVisitorLocale();
				return $this->storeLocaleAndRedirect($request, 'memberLocale', $memberLocale);
			}			
		}else{
			$visitorLocale = Session()->get('visitorLocale');
			if(!$visitorLocale){
				$visitorLocale = $this->getVisitorLocale();
				return $this->storeLocaleAndRedirect($request, 'visitorLocale', $visitorLocale);
			}
		}
				
		return $next($request);
	}
	
	
	private function storeLocaleAndRedirect(Request $request, $var, $locale){
		$request->Session()->put($var, $locale);
		$request->Session()->put('locale', $locale);
		$url = $this->setVisitorUrl($request, $locale);
		return redirect()->to($url)->withCookie(cookie('locale', $locale, 86400));
	}

}
