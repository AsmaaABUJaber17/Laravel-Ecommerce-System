WORKDIR /var/www/html

# نسخ ملفات المشروع (composer.json أولًا لتسريع cache)
COPY composer.json composer.lock ./

# نسخ باقي الملفات
COPY . .

# نسخ Composer من الصورة الرسمية
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# الآن يمكن تشغيل composer install
RUN composer install --no-dev --optimize-autoloader

# بقية الأوامر
RUN php artisan config:clear \
    && php artisan route:clear \
    && php artisan cache:clear
