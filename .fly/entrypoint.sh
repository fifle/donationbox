#!/usr/bin/env sh

# Run user scripts, if they exist
for f in /var/www/html/.fly/scripts/*.sh; do
    # Bail out this loop if any script exits with non-zero status code
    bash "$f" || break
done

# Ownership was set at build time; only fix writable runtime dirs.
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache 2>/dev/null || true

if [ $# -gt 0 ]; then
    set -- docker-php-serversideup-entrypoint "$@"
else
    set -- docker-php-serversideup-entrypoint /init
fi

# Docker: we are already PID 1. Fly/Heroku/Fargate inject their own PID 1,
# and s6-overlay v3 refuses to start unless it is PID 1 — so create a nested
# PID namespace (standard workaround for serversideup on Fly).
if [ "$$" -eq 1 ]; then
    exec "$@"
fi

exec unshare --pid --fork --kill-child=SIGTERM --mount-proc \
    perl -e '$SIG{INT}=""; $SIG{TERM}=""; exec @ARGV' -- \
    "$@"
