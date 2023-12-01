<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        $query = request()->query();
        $querycount = count($query);
        foreach ($query as $key => $value) {
            if ($value == '') {
                unset($query[$key]);
            }
        }
        if ($querycount > count($query)) {
            $path = url()->current() . (!empty($query) ? '?' . http_build_query($query) : '');
            return redirect()->to($path);
        }
        return $next($request);
    }
}
