FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    git \
    curl \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libwebp-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zlib-dev \
    zip \
    unzip \
    mysql-client

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY ./backend /var/www

RUN chown -R www-data:www-data storage bootstrap bootstrap/cache
RUN chmod -R 775 storage bootstrap bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

RUN php artisan key:generate --force
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

EXPOSE 9000
CMD ["php-fpm"]
CMD ["php", "artisan", "migrate"]
CMD ["php", "artisan", "db:seed"]