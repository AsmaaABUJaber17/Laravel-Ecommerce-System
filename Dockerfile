FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

RUN a2enmod rewrite

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

WORKDIR /var/www/html/src

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Apache DocumentRoot fix (Laravel in src/)
RUN sed -i 's|/var/www/html|/var/www/html/src/public|g' \
    /etc/apache2/sites-available/000-default.conf

EXPOSE 80
