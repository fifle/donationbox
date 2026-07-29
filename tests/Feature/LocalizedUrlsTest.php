<?php

namespace Tests\Feature;

use Tests\TestCase;

class LocalizedUrlsTest extends TestCase
{
    /**
     * @var array
     */
    private $donation = [
        'campaign_title' => 'Test Fund',
        'detail' => 'Annetus',
        'payee' => 'Someone',
        'iban' => 'EE534204278619625400',
    ];

    /**
     * The switcher must keep the donation box configuration when changing language.
     *
     * @return void
     */
    public function testLanguageSwitcherKeepsQueryParametersOnGetPages()
    {
        $response = $this->get('/donation?' . http_build_query($this->donation) . '&locale=ru');

        $response->assertStatus(200);
        $this->assertPageContains($response, $this->donationUrl(['locale' => 'en']));
    }

    /**
     * Parameters posted as a form body are not in the URL, so links must be rebuilt from the
     * request input instead of from url()->full().
     *
     * @return void
     */
    public function testLanguageSwitcherKeepsPostedParameters()
    {
        $response = $this->post('/donation', array_merge($this->donation, ['locale' => 'ru']));

        $response->assertStatus(200);
        $this->assertPageContains($response, $this->donationUrl(['locale' => 'en']));
    }

    /**
     * A posted page must still advertise a shareable GET address, not a bare path.
     *
     * @return void
     */
    public function testPostedPageAdvertisesShareableUrl()
    {
        $response = $this->post('/donation', $this->donation);

        $response->assertStatus(200);
        $this->assertPageContains($response, $this->donationUrl());
    }

    /**
     * The CSRF token belongs to the form, never to a link a donor can share.
     *
     * @return void
     */
    public function testPostedUrlsOmitTheCsrfToken()
    {
        $response = $this->post('/donation', array_merge($this->donation, ['_token' => 'secret-token']));

        $response->assertStatus(200);
        $this->assertStringNotContainsString('secret-token', $this->plainText($response));
    }

    /**
     * Locale variants are one page, so crawlers get a single canonical address.
     *
     * @return void
     */
    public function testCanonicalUrlDropsTheLocale()
    {
        $response = $this->get('/donation?' . http_build_query($this->donation) . '&locale=ru');

        $response->assertStatus(200);
        $this->assertPageContains($response, '<link rel="canonical" href="' . $this->donationUrl() . '"/>');
    }

    /**
     * A crawler must not see one page under two spellings of the same address.
     *
     * @return void
     */
    public function testCanonicalUrlMatchesTheAddressThatPageReportsForItself()
    {
        $canonical = $this->donationUrl();

        $localized = $this->get('/donation?' . http_build_query($this->donation) . '&locale=ru');
        $this->assertPageContains($localized, '<link rel="canonical" href="' . $canonical . '"/>');

        $plain = $this->get($canonical);
        $this->assertPageContains($plain, '<meta property="og:url" content="' . $canonical . '"/>');
    }

    /**
     * The Referer header is third-party controlled, so it must not steer the redirect off-site.
     *
     * @return void
     */
    public function testLangRedirectIgnoresExternalReferer()
    {
        $response = $this->withHeader('referer', 'https://www.google.com/')->get('/lang/en');

        $response->assertRedirect('http://localhost?locale=en');
        $response->assertHeader('X-Robots-Tag', 'noindex');
    }

    /**
     * Links published before the switcher moved to ?locale= URLs must keep working.
     *
     * @return void
     */
    public function testLangRedirectFollowsSameHostReferer()
    {
        $response = $this->withHeader('referer', 'http://localhost/about?foo=bar')->get('/lang/ru');

        $response->assertRedirect('http://localhost/about?foo=bar&locale=ru');
    }

    /**
     * The donation page address as the application normalises it.
     *
     * @param array $extra
     * @return string
     */
    private function donationUrl(array $extra = []): string
    {
        $params = array_merge($this->donation, $extra);
        ksort($params);

        return 'http://localhost/donation?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * @param \Illuminate\Testing\TestResponse $response
     * @param string $needle
     * @return void
     */
    private function assertPageContains($response, string $needle)
    {
        $this->assertStringContainsString($needle, $this->plainText($response));
    }

    /**
     * Blade escapes ampersands, so compare against the decoded markup.
     *
     * @param \Illuminate\Testing\TestResponse $response
     * @return string
     */
    private function plainText($response): string
    {
        return html_entity_decode($response->getContent(), ENT_QUOTES);
    }
}
