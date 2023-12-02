<?php

namespace App\Http\Middleware;

use Barryvdh\Debugbar\Facades\Debugbar;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StripEmptyParams
{
    /**
     * Trimming empty parameters on GET request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $query = $request->query();
        $querycount = count($query);
        foreach ($query as $key => $value) {
            if ($value == '') {
                unset($query[$key]);
            }
        }
        if ($querycount > count($query)) {
            $path = $request->url(); // Use the url() method which excludes query string
            $queryString = http_build_query($query); // Build the query string without empty params
            $redirectUrl = $queryString ? $path.'?'.$queryString : $path; // Concatenate properly
            return redirect()->to($redirectUrl); // Redirect to the cleansed URL
        }

        return $next($request);
    }
}
