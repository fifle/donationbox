<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if locale is specified in URL
        if ($request->has('locale')) {
            $locale = $request->input('locale');
            
            // Validate locale
            $validLocales = ['en', 'ru', 'ee', 'lv', 'lt'];
            if (in_array($locale, $validLocales)) {
                App::setLocale($locale);
                session()->put('locale', $locale);
            }
        } 
        // Fallback to session if URL parameter is not present
        elseif (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
        
        return $next($request);
    }
}
