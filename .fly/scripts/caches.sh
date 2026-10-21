#!/usr/bin/env bash

php /var/www/html/artisan config:cache --no-ansi -q
php /var/www/html/artisan route:cache --no-ansi -q
php /var/www/html/artisan view:cache --no-ansi -q
