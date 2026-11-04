# syntax=docker/dockerfile:1

# 1) Dependências PHP (sem dev)
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --optimize --no-dev --no-scripts

# 2) Assets (Vite + Tailwind)
FROM node:24-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts
COPY . .
COPY --from=vendor /app/vendor ./vendor
RUN npm run build

# 3) Runtime: FrankenPHP (Caddy + PHP em um só processo)
FROM dunglas/frankenphp:1-php8.3
RUN install-php-extensions pdo_pgsql intl zip opcache
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

ENV SERVER_NAME=:8000 \
    APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

WORKDIR /app
COPY --from=vendor /app /app
COPY --from=assets /app/public/build /app/public/build
COPY docker/entrypoint.sh /usr/local/bin/entrypoint

RUN php artisan package:discover \
    && php artisan filament:assets \
    && useradd --create-home --uid 1000 app \
    && chown -R app:app /app/storage /app/bootstrap/cache /data/caddy /config/caddy \
    && chmod +x /usr/local/bin/entrypoint

USER app
EXPOSE 8000
ENTRYPOINT ["entrypoint"]
CMD ["frankenphp", "run", "--config", "/etc/frankenphp/Caddyfile"]
