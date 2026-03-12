FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

RUN cp src/.env.example src/.env

WORKDIR /app/src

RUN php artisan key:generate

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000
