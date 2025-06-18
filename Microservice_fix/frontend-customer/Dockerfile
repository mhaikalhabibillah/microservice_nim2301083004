# Dockerfile
FROM php:8.2-fpm


# Install dependency PHP dan ekstensi Laravel
RUN apt-get update && apt-get install -y \
   build-essential libpng-dev libjpeg-dev libonig-dev libxml2-dev zip unzip git curl \
   && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd


# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# Set working directory
WORKDIR /var/www


COPY . .


RUN composer install


# Berikan permission
RUN chown -R www-data:www-data /var/www \
   && chmod -R 755 /var/www


EXPOSE 9000
CMD ["php-fpm"]
