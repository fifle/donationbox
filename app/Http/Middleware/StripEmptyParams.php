<?php

namespace App\Http\Middleware;

use App\Helpers\DonationUrlBuilder;
use Closure;
use Illuminate\Http\Request;

class StripEmptyParams
{
    /**
     * Strip empty parameters and canonicalize query string encoding on GET requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $redirectUrl = DonationUrlBuilder::canonicalRedirectUrl($request);

        if ($redirectUrl !== null) {
            return redirect()->to($redirectUrl);
        }

        return $next($request);
    }
}
