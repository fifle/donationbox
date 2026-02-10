<p align="center"><a href="https://donationbox.ee/" target="_blank"><img src="https://donationbox.ee/img/db-logo-fl.png" width="300"></a></p>

## About DonationBox
DonationBox is a web application for generating payment links for one-time or recurring donations for Estonian, Latvian and Lithuanian and other international payment systems. This method allows to receive for individuals and companies (all legal forms allowed in EE, LV and LT that are eligible to have bank accounts in these countries). The app allows you to create your own virtual donation box for donations without having to write code or link your website or app to contracts and integrations with banklink.

We provide a convenient interface for donors so that they don't have to enter data manually or copy it. The donor only has to follow a link by scanning a QR-code or going to a direct URL-address, enter the amount of donation, choose the transfer type - one-time or regular payment (single or standing order), and choose your bank, payment method with credit cards or other payment type.

## Modes
DonationBox offers two ways to collect payments:

- **Donation box (create new)** — Create a reusable donation page where the donor enters the amount, chooses one-time or recurring payment, then selects their bank or card. Share the link or embed it on your website. Ideal for campaigns, fundraisers, and ongoing support.
- **Cashier mode** — Set a fixed amount and get a dedicated QR code and URL for that amount. The donor scans or opens the link and pays the preset sum. Ideal for in-person payments, money requests, and “pay this exact amount” flows (similar to bank money-request features, but across all supported payment methods in one place).

## Supported banks
* Estonia: Swedbank, SEB, LHV, Coop Pank
* Latvia: Swedbank, SEB
* Lithuania: Swedbank, SEB

## Supported payment methods
* I-banks
* Paypal (Paypal.me for individuals, Paypal Hosted Button)
* Revolut (for individuals only)
* Donorbox (allows to connect Stripe and Paypal)
* Stripe (Payment Link – Visa/Mastercard and other cards)

## FAQ and help
The [FAQ page](https://donationbox.ee/about) covers setup, security, and payment methods. Most important topics:

| Topic | Link |
|-------|------|
| What is DonationBox? | [donationbox.ee/about#whatIsDonationBox](https://donationbox.ee/about#whatIsDonationBox) |
| Cashier mode (fixed amount, QR/link) | [donationbox.ee/about#cashierMode](https://donationbox.ee/about#cashierMode) |
| Security and phishing | [donationbox.ee/about#security](https://donationbox.ee/about#security) |
| Data and privacy | [donationbox.ee/about#dataSecurity](https://donationbox.ee/about#dataSecurity) |
| Stripe Payment Link setup | [donationbox.ee/about#stripe](https://donationbox.ee/about#stripe) |
| Donorbox campaign slug | [donationbox.ee/about#donorbox](https://donationbox.ee/about#donorbox) |
| PayPal / Revolut setup | [donationbox.ee/about#paypal](https://donationbox.ee/about#paypal), [donationbox.ee/about#revolut](https://donationbox.ee/about#revolut) |
| Embed widget on your site | [donationbox.ee/about#widget](https://donationbox.ee/about#widget) |
| Edit existing form | [donationbox.ee/about#editForm](https://donationbox.ee/about#editForm) |
| Report fraud | [donationbox.ee/about#fraud](https://donationbox.ee/about#fraud) |
| Get help | [donationbox.ee/about#needHelp](https://donationbox.ee/about#needHelp) |

## Quick links
- [Create your first DonationBox](https://donationbox.ee)
- [FAQ (all topics)](https://donationbox.ee/about)
- [Support the project (buy us a hot choco)](https://donationbox.ee/donation?campaign_title=Support+Donationbox.ee&detail=Annetus+donationbox.ee&payee=Pavel+Flei%C5%A1er&iban=EE614204278622417401&pp=pfleiser&rev=pavelvtd)

## Coming soon
- [x] Support of Latvian and Lithuanian banks
- [x] Multi-language interface (Estonian, Russian, Latvian and Lithuanian)
- [x] Stripe payment method (Payment Link)
- [ ] QR-code generation in PDF format
- [ ] Blockchain wallets support (Bitcoin URI protocol, other blockchain payment providers)

## License
DonationBox is open-sourced software licensed under the [GNU GPLv3 license](https://spdx.org/licenses/GPL-3.0-or-later.html). Source code: [github.com/fifle/donationbox](https://github.com/fifle/donationbox).

## Installation
You can deploy DonationBox on your personal server for the needs of your NGO. Please contact us by email if you need any support: [donationbox.ee@gmail.com](mailto:donationbox.ee@gmail.com)

NB! DonationBox requires installation of Imagick extension for PHP.

**Install dependencies**
- `composer install`
- `npm install`
- `npm run dev`

**Prepare your environment**
- `cp .env.example .env`
- `php artisan key:generate`

**Empty cache**
- `php artisan config:cache`
- `php artisan config:clear`
- `php artisan cache:clear`

**Run the application**
- `php artisan serve`

The default country is Estonia (EE), change the COUNTRY variable under .env to work with LV and LT.
