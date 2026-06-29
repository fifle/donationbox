<?php

namespace Tests\Unit;

use App\Helpers\DonationUrlBuilder;
use Illuminate\Http\Request;
use Tests\TestCase;

class DonationUrlBuilderTest extends TestCase
{
    public function test_build_query_string_encodes_ampersands_in_text_fields(): void
    {
        $query = DonationUrlBuilder::buildQueryString([
            'campaign_title' => 'MTÜ HOPE & LOVE',
            'payee' => 'MTÜ HOPE & LOVE',
            'detail' => 'Help & support',
        ]);

        $this->assertStringContainsString('%26', $query);
        $this->assertStringNotContainsString(' HOPE & LOVE', $query);

        parse_str($query, $parsed);

        $this->assertSame('MTÜ HOPE & LOVE', $parsed['campaign_title']);
        $this->assertSame('MTÜ HOPE & LOVE', $parsed['payee']);
        $this->assertSame('Help & support', $parsed['detail']);
    }

    public function test_canonical_redirect_url_normalizes_unencoded_special_characters(): void
    {
        $request = Request::create(
            '/embed',
            'GET',
            [
                'campaign_title' => 'MTÜ HOPE & LOVE',
                'detail' => 'Annetus',
                'payee' => 'MTÜ HOPE & LOVE',
                'rec' => '1',
            ],
            [],
            [],
            ['QUERY_STRING' => 'campaign_title=MT%C3%9C+HOPE+%26+LOVE&detail=Annetus&payee=MT%C3%9C+HOPE+%26+LOVE&rec=1']
        );

        $this->assertNull(DonationUrlBuilder::canonicalRedirectUrl($request));

        $request = Request::create(
            '/embed?campaign_title=MT%C3%9C+HOPE+%26+LOVE&detail=Annetus&extra=',
            'GET'
        );

        $redirectUrl = DonationUrlBuilder::canonicalRedirectUrl($request);

        $this->assertNotNull($redirectUrl);
        $this->assertStringContainsString('campaign_title=MT%C3%9C+HOPE+%26+LOVE', $redirectUrl);
        $this->assertStringNotContainsString('extra=', $redirectUrl);
    }

    public function test_build_from_request_uses_given_path(): void
    {
        $request = Request::create(
            '/donation',
            'GET',
            ['campaign_title' => 'A & B', 'detail' => 'C']
        );

        $embedUrl = DonationUrlBuilder::buildFromRequest($request, 'embed');

        $this->assertStringContainsString('/embed?', $embedUrl);
        $this->assertStringContainsString('campaign_title=A+%26+B', $embedUrl);
    }
}
