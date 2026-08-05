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
WORKDIR /var/www/html/gimnasio-app

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --no-interaction --prefer-dist
RUN npm install --ignore-scripts

RUN cp .env.example .env \
    && php artisan key:generate \
    && npm run build

EXPOSE 8000

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8000} -t public"]
