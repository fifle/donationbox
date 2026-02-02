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
        $validLocales = ['en', 'ru', 'ee', 'lv', 'lt'];

        // Locale parameter takes precedence - if present and valid, use it
        if ($request->has('locale')) {
            $locale = $request->input('locale');
            if (in_array($locale, $validLocales)) {
                App::setLocale($locale);
                session()->put('locale', $locale);
            }
        }
        // Fallback to session if URL parameter is not present
        elseif (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
        // Default: use country language (Estonia->Estonian, Latvia->Latvian, Lithuania->Lithuanian, else English)
        else {
            $country = env('COUNTRY', '');
            switch ($country) {
                case 'ee': $defaultLocale = 'ee'; break;
                case 'lv': $defaultLocale = 'lv'; break;
                case 'lt': $defaultLocale = 'lt'; break;
                default: $defaultLocale = 'en';
            }
            App::setLocale($defaultLocale);
        }

        return $next($request);
    }
}
