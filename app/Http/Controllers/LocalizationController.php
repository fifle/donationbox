<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class LocalizationController extends Controller
{
    /**
     * @param $locale
     * @return RedirectResponse
     */
    public function index($locale, Request $request)
    {
        // Validate locale
        $validLocales = ['en', 'ru', 'ee', 'lv', 'lt'];
        if (!in_array($locale, $validLocales)) {
            $locale = 'en'; // Default to English if invalid locale
        }
        
        App::setLocale($locale);
        session()->put('locale', $locale);
        
        // Get the previous URL
        $previousUrl = URL::previous();
        $redirectUrl = $this->updateUrlWithLocale($previousUrl, $locale);
        
        return redirect($redirectUrl);
    }
    
    /**
     * Update URL with locale parameter
     * 
     * @param string $url
     * @param string $locale
     * @return string
     */
    private function updateUrlWithLocale($url, $locale)
    {
        $parsedUrl = parse_url($url);
        $query = isset($parsedUrl['query']) ? $parsedUrl['query'] : '';
        
        parse_str($query, $queryParams);
        $queryParams['locale'] = $locale;
        
        $newQuery = http_build_query($queryParams);
        
        $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
        $host = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';
        $port = isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '';
        $path = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
        $fragment = isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '';
        
        return $scheme . $host . $port . $path . '?' . $newQuery . $fragment;
    }
}
