<?php

namespace App\Helpers;

use Illuminate\Support\Arr;

/**
 * Builds shareable GET URLs for the page being rendered.
 *
 * A donation box is entirely described by its parameters, and every page normally arrives
 * as a GET link that carries them in the query string. The same controllers also answer
 * POST, where those parameters sit in the request body instead, so url()->full() returns a
 * bare path. Anything derived from it — the share link, QR code, edit link, language
 * switcher — would then point at a page stripped of its configuration.
 */
class CurrentUrl
{
    /**
     * Fields Laravel adds to form posts that must never end up in a shared link.
     */
    private const FRAMEWORK_PARAMS = ['_token', '_method'];

    /**
     * Parameters describing the current page, however they were submitted.
     *
     * @return array
     */
    public static function params(): array
    {
        $request = request();

        if ($request->isMethod('GET')) {
            return $request->query();
        }

        return Arr::except($request->all(), self::FRAMEWORK_PARAMS);
    }

    /**
     * The current page as a GET URL.
     *
     * A GET query string is passed through untouched so existing links, QR codes and their
     * exact encoding stay byte-for-byte identical.
     *
     * @return string
     */
    public static function full(): string
    {
        $request = request();

        if ($request->isMethod('GET')) {
            return $request->fullUrl();
        }

        return self::build(self::params());
    }

    /**
     * The current page as a GET URL with parameters added, replaced or removed.
     *
     * @param array $overrides parameters to set, e.g. ['locale' => 'ru']
     * @param array $except parameter names to drop, e.g. ['locale']
     * @return string
     */
    public static function with(array $overrides = [], array $except = []): string
    {
        return self::build(Arr::except(array_merge(self::params(), $overrides), $except));
    }

    /**
     * @param array $params
     * @return string
     */
    private static function build(array $params): string
    {
        $request = request();

        if (!$params) {
            return $request->url();
        }

        // Normalise exactly the way Request::fullUrl() does, so a URL built here is
        // byte-identical to the one the same page reports for itself once fetched by GET.
        // Otherwise the canonical tag and og:url would disagree on encoding and ordering.
        ksort($params);
        $separator = $request->getBaseUrl() . $request->getPathInfo() === '/' ? '/?' : '?';

        return $request->url() . $separator . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }
}
