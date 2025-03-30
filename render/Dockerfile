# Laravel + PHP 8.2 + Composer
FROM php:8.2-fpm

# Install vajalikud süsteemipaketid
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libmcrypt-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Määra töökaust
WORKDIR /var/www/html

# Kopeeri kogu projekt Dockeri konteinerisse
COPY . .

# Installi PHP sõltuvused
RUN composer install --no-dev --optimize-autoloader

# Käivita Laravel setup
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan storage:link || true

# Ava pordi 8000
EXPOSE 8000

# Käivita Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
