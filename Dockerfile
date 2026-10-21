# syntax = docker/dockerfile:experimental

# Pin a patched PHP patch release (CVE-2026-109618 / CVE-2026-109619).
# Fixed lines: 8.2.35, 8.3.36, 8.4.27, 8.5.12. Laravel 8 targets 8.2.x.
ARG PHP_VERSION=8.2.35
ARG NODE_VERSION=20
FROM serversideup/php:${PHP_VERSION}-fpm-nginx-v5.0.2 AS base

USER root

ARG PHP_VERSION

LABEL fly_launch_runtime="laravel"

# TLS is terminated at the Fly edge; NGINX serves HTTP on 8080.
ENV SSL_MODE=off
ENV AUTORUN_ENABLED=false
ENV PHP_OPCACHE_ENABLE=1
ENV TRUSTED_PROXY=fly

RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl zip unzip rsync ca-certificates vim htop cron \
    && install-php-extensions bcmath gd imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY --chown=www-data:www-data . /var/www/html

RUN composer install --optimize-autoloader --no-dev \
    && mkdir -p storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && su -s /bin/sh www-data -c "php artisan optimize:clear" \
    && sed -i 's/protected \$proxies;/protected \$proxies = "*";/g' app/Http/Middleware/TrustProxies.php \
    && ln -sf /usr/local/bin/php /usr/bin/php \
    && echo "MAILTO=\"\"\n* * * * * www-data /usr/local/bin/php /var/www/html/artisan schedule:run" > /etc/cron.d/laravel \
    && chmod 0644 /etc/cron.d/laravel \
    && cp .fly/nginx-websockets.conf /etc/nginx/conf.d/websockets.conf \
    && cp .fly/nginx-probe-shield.conf /etc/nginx/conf.d/probe-shield.conf \
    && cp .fly/nginx-http.conf.template /etc/nginx/site-opts.d/http.conf.template \
    && cp .fly/nginx-trusted-proxy-fly.conf /etc/nginx/trusted-proxy/fly.conf \
    && sed -i '/X-Frame-Options/d' /etc/nginx/server-opts.d/security.conf \
    && cp .fly/entrypoint.sh /entrypoint \
    && chmod +x /entrypoint

# Multi-stage build: Build static assets
FROM node:${NODE_VERSION} AS node_modules_go_brrr

WORKDIR /app
COPY . .
COPY --from=base /var/www/html/vendor /app/vendor

RUN if [ -f "vite.config.js" ]; then \
        ASSET_CMD="build"; \
    else \
        ASSET_CMD="production"; \
    fi; \
    if [ -f "yarn.lock" ]; then \
        yarn install --frozen-lockfile; \
        yarn $ASSET_CMD; \
    elif [ -f "package-lock.json" ]; then \
        npm ci --no-audit; \
        npm run $ASSET_CMD; \
    else \
        npm install; \
        npm run $ASSET_CMD; \
    fi;

FROM base

USER root

COPY --from=node_modules_go_brrr /app/public /var/www/html/public-npm
RUN if [ -d /var/www/html/public-npm ]; then \
        cp -r /var/www/html/public-npm/. /var/www/html/public/ 2>/dev/null || true; \
    fi \
    && rm -rf /var/www/html/public-npm \
    && chown -R www-data:www-data /var/www/html/public

EXPOSE 8080

ENTRYPOINT ["/entrypoint"]
CMD ["/init"]
