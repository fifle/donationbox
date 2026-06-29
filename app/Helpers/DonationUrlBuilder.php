<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class DonationUrlBuilder
{
    /**
     * Remove empty query parameter values.
     */
    public static function filterEmptyParams(array $query): array
    {
        return array_filter($query, function ($value) {
            return $value !== '' && $value !== null;
        });
    }

    /**
     * Build a query string with ampersands and other special characters encoded.
     */
    public static function buildQueryString(array $query): string
    {
        return http_build_query(self::filterEmptyParams($query));
    }

    /**
     * Build a full URL for the current request path with a canonical query string.
     */
    public static function fromRequest(Request $request): string
    {
        $queryString = self::buildQueryString($request->query());
        $url = $request->url();

        return $queryString !== '' ? $url.'?'.$queryString : $url;
    }

    /**
     * Build a full URL for a given path with the request's query parameters.
     */
    public static function buildFromRequest(Request $request, string $path): string
    {
        $queryString = self::buildQueryString($request->query());
        $base = rtrim($request->getSchemeAndHttpHost(), '/').'/'.ltrim($path, '/');

        return $queryString !== '' ? $base.'?'.$queryString : $base;
    }

    /**
     * Return a redirect URL when the raw query string should be canonicalized.
     */
    public static function canonicalRedirectUrl(Request $request): ?string
    {
        $filtered = self::filterEmptyParams($request->query());
        $canonicalQuery = self::buildQueryString($filtered);
        $currentQuery = $request->server('QUERY_STRING') ?? '';

        if ($canonicalQuery === $currentQuery) {
            return null;
        }

        parse_str($canonicalQuery, $canonicalParsed);
        parse_str($currentQuery, $currentParsed);
        $currentFiltered = self::filterEmptyParams($currentParsed);

        if ($canonicalParsed !== $currentFiltered) {
            return null;
        }

        $url = $request->url();

        return $canonicalQuery !== '' ? $url.'?'.$canonicalQuery : $url;
    }
}
