# Gunakan image yang lebih stabil untuk production
FROM php:8.2-apache

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Aktifkan mod_rewrite untuk Laravel
RUN a2enmod rewrite

# Setup DocumentRoot ke folder public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy file project
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependensi PHP (tanpa dev)
RUN composer install --no-dev --optimize-autoloader

# Set permission yang benar
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Hapus file konfigurasi MPM yang mungkin berkonflik jika ada (opsional)
RUN rm -f /etc/apache2/mods-enabled/mpm_event.conf && \
    rm -f /etc/apache2/mods-enabled/mpm_worker.conf

# Port 80
EXPOSE 80
