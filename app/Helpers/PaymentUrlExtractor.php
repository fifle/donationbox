<?php

namespace App\Helpers;

/**
 * Extracts payment provider identifiers from full URLs that users mistakenly paste
 * instead of just the required slug/ID/username values.
 *
 * For example, a user might paste "https://donorbox.org/my-campaign" into the Donorbox
 * field instead of just "my-campaign". This class detects such cases and extracts the
 * correct value.
 */
class PaymentUrlExtractor
{
    /**
     * Extract Donorbox campaign slug from a value that may be a full URL.
     * Expected: "my-campaign-slug"
     * User might paste: "https://donorbox.org/my-campaign-slug" or "donorbox.org/my-campaign-slug"
     *
     * @param string|null $value
     * @return string|null
     */
    public static function extractDonorbox(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        $value = trim($value);

        // Check if it looks like a donorbox.org URL
        if (preg_match('~(?:https?://)?(?:www\.)?donorbox\.org/([^/?&#]+)~i', $value, $matches)) {
            return $matches[1];
        }

        return $value;
    }

    /**
     * Extract PayPal.me username from a value that may be a full URL.
     * Expected: "MyUsername"
     * User might paste: "https://paypal.me/MyUsername?locale.x=ru_RU&country.x=EE"
     *
     * @param string|null $value
     * @return string|null
     */
    public static function extractPaypalMe(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        $value = trim($value);

        // Check if it looks like a paypal.me URL
        if (preg_match('~(?:https?://)?(?:www\.)?paypal\.me/([^/?&#]+)~i', $value, $matches)) {
            return $matches[1];
        }

        return $value;
    }

    /**
     * Extract Stripe Payment Link ID from a value that may be a full URL.
     * Expected: "4gMbJ17B56688HK1TE9MY00"
     * User might paste: "https://buy.stripe.com/4gMbJ17B56688HK1TE9MY00"
     *                 or "https://donate.stripe.com/4gMbJ17B56688HK1TE9MY00"
     *
     * @param string|null $value
     * @return string|null
     */
    public static function extractStripe(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        $value = trim($value);

        // Check if it looks like a stripe.com URL (buy.stripe.com or donate.stripe.com)
        if (preg_match('~(?:https?://)?(?:buy|donate)\.stripe\.com/([^/?&#]+)~i', $value, $matches)) {
            return $matches[1];
        }

        return $value;
    }

    /**
     * Extract Revolut.me username from a value that may be a full URL.
     * Expected: "myusername"
     * User might paste: "https://revolut.me/myusername"
     *
     * @param string|null $value
     * @return string|null
     */
    public static function extractRevolut(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        $value = trim($value);

        // Check if it looks like a revolut.me URL
        if (preg_match('~(?:https?://)?(?:www\.)?revolut\.me/([^/?&#]+)~i', $value, $matches)) {
            return $matches[1];
        }

        return $value;
    }

    /**
     * Extract PayPal Hosted Button ID from a value that may be a full URL.
     * Expected: "ABCDEF123456"
     * User might paste: "https://www.paypal.com/donate/?hosted_button_id=ABCDEF123456"
     *
     * @param string|null $value
     * @return string|null
     */
    public static function extractPaypalHostedButton(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        $value = trim($value);

        // Check if it looks like a paypal.com/donate URL with hosted_button_id parameter
        if (preg_match('~(?:https?://)?(?:www\.)?paypal\.com/donate/?.*[?&]hosted_button_id=([^&#]+)~i', $value, $matches)) {
            return $matches[1];
        }

        return $value;
    }

    /**
     * Extract SEB UID from a value that may contain a full URL.
     * Expected: UUID format like "f0233a8a-2c62-414d-a8e0-868d5ca345cb"
     * User might paste a URL containing the UID.
     *
     * @param string|null $value
     * @return string|null
     */
    public static function extractSebUid(?string $value): ?string
    {
        if (empty($value)) {
            return $value;
        }

        $value = trim($value);

        // If value contains a URL with UID parameter, extract it
        if (preg_match('~[?&]UID=([a-f0-9-]+)~i', $value, $matches)) {
            return $matches[1];
        }

        // If value is already a UUID, return as-is
        if (preg_match('~^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$~i', $value)) {
            return $value;
        }

        // Try to find a UUID anywhere in the value
        if (preg_match('~([a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12})~i', $value, $matches)) {
            return $matches[1];
        }

        return $value;
    }

    /**
     * Apply all extraction rules to a set of payment parameters.
     * This is the main entry point for sanitizing user input.
     *
     * @param array $params Associative array with keys: pp, db, strp, rev, pphb, sebuid, sebuid_st
     * @return array The same array with URL values extracted to their needed identifiers
     */
    public static function extractAll(array $params): array
    {
        if (isset($params['pp'])) {
            $params['pp'] = self::extractPaypalMe($params['pp']);
        }

        if (isset($params['db'])) {
            $params['db'] = self::extractDonorbox($params['db']);
        }

        if (isset($params['strp'])) {
            $params['strp'] = self::extractStripe($params['strp']);
        }

        if (isset($params['rev'])) {
            $params['rev'] = self::extractRevolut($params['rev']);
        }

        if (isset($params['pphb'])) {
            $params['pphb'] = self::extractPaypalHostedButton($params['pphb']);
        }

        if (isset($params['sebuid'])) {
            $params['sebuid'] = self::extractSebUid($params['sebuid']);
        }

        if (isset($params['sebuid_st'])) {
            $params['sebuid_st'] = self::extractSebUid($params['sebuid_st']);
        }

        return $params;
    }
}
