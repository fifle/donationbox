<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
{
    /**
     * FAQ card IDs mapped to their title translation keys (English key).
     */
    protected const FAQ_TITLE_KEYS = [
        'whatIsDonationBox' => 'What is a DonationBox?',
        'cashierMode' => 'What is Cashier mode? How does it work?',
        'free' => 'Why is DonationBox free?',
        'security' => "Is this website secure? Isn't it phishing?",
        'checkYourBank' => "How do you check that you really got to your bank's website and not some fake page asking for banking information?",
        'dataSecurity' => "Okay, but how do you protect and store my data? Will my transactions be visible to others?",
        'bankDetails' => 'Why is it important to keep payment details serious and clear?',
        'sebUID' => 'What is SEB UID token? How do I get it?',
        'donorbox' => 'What is Donorbox and how can I find my campaign slug?',
        'stripe' => 'What is Stripe and how do I set up a Payment Link for DonationBox?',
        'paypal' => 'What is Paypal and how do I find my paypal.me username?',
        'revolut' => 'What is Revolut? How can I find my Revolut.me link?',
        'estBanks' => 'Which banks operating in the Baltics are currently supported?',
        'fraud' => 'I see that fraudsters are using the service or spreading false information. What should I do?',
        'widget' => 'I want to put a donation form widget on my website. How can I do this?',
        'foreignIBAN' => 'Can payee use a foreign IBAN account number?',
        'withoutEstBanks' => 'Can I use DonationBox only for Revolut, Donorbox and Paypal?',
        'paymentTypeDiff' => 'What is the difference between a one-time donation and a regular donation? Where is this configured?',
        'editForm' => 'Can I change the data in an existing form?',
        'bugs' => 'I found a bug or other inaccuracy. Where do I report it?',
        'payeeBg' => "What does the \"Check payee's background\" link mean?",
        'anonymous' => 'Can I remain anonymous when making a payment?',
        'needHelp' => 'I need help creating my DonationBox. Who can I contact?',
    ];

    /**
     * Build FAQ search index: for each card, collect titles in all locales.
     * Search works regardless of which language the user is viewing.
     */
    public function index(): array
    {
        $locales = ['en', 'ee', 'lv', 'lt', 'ru'];
        $searchIndex = [];

        foreach (self::FAQ_TITLE_KEYS as $cardId => $translationKey) {
            $strings = [];
            foreach ($locales as $locale) {
                $translated = $this->getTranslation($locale, $translationKey);
                if ($translated) {
                    $strings[] = $this->normalizeForSearch($translated);
                }
            }
            $strings[] = $this->normalizeForSearch($translationKey);
            $searchIndex[$cardId] = array_values(array_unique($strings));
        }

        return $searchIndex;
    }

    protected function getTranslation(string $locale, string $key): ?string
    {
        $path = resource_path("lang/{$locale}.json");
        if (! File::exists($path)) {
            return null;
        }
        $data = json_decode(File::get($path), true);
        return $data[$key] ?? null;
    }

    protected function normalizeForSearch(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/[\s\p{P}]+/u', ' ', $text);
        return trim($text);
    }

    public function show()
    {
        $locale = app()->getLocale();
        $faqToc = [];
        foreach (array_keys(self::FAQ_TITLE_KEYS) as $cardId) {
            $key = self::FAQ_TITLE_KEYS[$cardId];
            $title = __($key);
            $faqToc[] = ['id' => $cardId, 'title' => $title];
        }

        return view('pages.about', [
            'faqSearchIndex' => $this->index(),
            'faqToc' => $faqToc,
        ]);
    }
}
