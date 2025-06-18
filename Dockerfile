# Gunakan PHP dengan Apache
FROM php:8.2-apache

# Install ekstensi dan alat bantu
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy semua file dari proyek ke container
COPY . .

# Install dependency Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Set permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Tambahkan konfigurasi Apache (kita buat di langkah berikutnya)
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
