FROM php:8.4-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git unzip curl libicu-dev libonig-dev libzip-dev libxml2-dev gnupg ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html/gimnasio-app

COPY gimnasio-app/ ./

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PORT=8000
ENV APP_ENV=production
ENV APP_DEBUG=false

RUN composer install --no-interaction --prefer-dist
RUN npm install --ignore-scripts

RUN rm -f .env bootstrap/cache/config.php \
    && cp .env.example .env \
    && php artisan key:generate --force \
    && php artisan config:clear \
    && npm run build

EXPOSE 8000

CMD ["sh", "-c", "php artisan config:clear && php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
