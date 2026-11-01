FROM php:8.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY core/ ./

COPY Docker/apache.conf /etc/apache2/sites-available/000-default.conf

RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && mkdir -p db storage/logs \
    && chown -R www-data:www-data db storage
