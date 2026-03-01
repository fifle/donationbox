# AGENTS.md

## Cursor Cloud specific instructions

### Overview

DonationBox is a stateless Laravel 8 web app that generates payment links for Baltic-region banks (EE/LV/LT) and international payment methods. All state is passed via URL parameters — **no database is required**.

### System dependencies (pre-installed in snapshot)

- PHP 8.2 (from `ppa:ondrej/php`) with extensions: imagick, gd, mbstring, xml, zip, curl, bcmath, intl, mysql, dom
- Composer 2.x (at `/usr/local/bin/composer`)
- Node.js 22 + npm 10

### Running the app

See `README.md` for standard commands. Key notes:

- `php artisan serve --host=0.0.0.0 --port=8000` starts the dev server
- The `COUNTRY` variable in `.env` controls which banks/routes are available (`ee`, `lv`, or `lt`); default is `ee`
- `composer install` must use `--ignore-platform-reqs` because the lock file has mixed PHP version constraints (some packages require `<8.2`, others require `>=8.2`)

### Testing

- `php artisan test` runs the PHPUnit test suite (2 tests: unit + feature example)
- No dedicated linter is configured in this repo

### Gotchas

- The `composer.lock` has conflicting PHP platform requirements; always pass `--ignore-platform-reqs` to `composer install`
- Frontend assets must be built with `npm run dev` (Laravel Mix) before the app renders correctly — CSS/JS won't load without this step
- The app is fully stateless: no DB migrations, no seeding, no Redis needed
- PHP deprecation warnings about `${var}` syntax in `voku/portable-utf8` are expected and harmless on PHP 8.2
