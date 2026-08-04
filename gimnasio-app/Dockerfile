FROM php:8.4-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git unzip curl libicu-dev libonig-dev libzip-dev libxml2-dev gnupg ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY gimnasio-app/composer.json gimnasio-app/composer.lock ./
RUN composer install --no-interaction --prefer-dist

COPY gimnasio-app/package.json gimnasio-app/package-lock.json ./
RUN npm install --ignore-scripts

COPY gimnasio-app/ ./
RUN cp .env.example .env \
    && php artisan key:generate \
    && npm run build

EXPOSE 8000

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
