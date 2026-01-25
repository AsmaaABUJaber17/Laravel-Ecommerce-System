FROM php:8.2-apache

# تثبيت المتطلبات
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# تفعيل mod_rewrite
RUN a2enmod rewrite

# تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# مجلد المشروع
WORKDIR /var/www/html

# نسخ ملفات Laravel
COPY . .

# تثبيت الحزم
RUN composer install --no-dev --optimize-autoloader

# صلاحيات
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Apache config
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
