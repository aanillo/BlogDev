FROM php:8.2-fpm

# Instalar dependencias y extensiones
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring bcmath zip curl

# Copiar proyecto
WORKDIR /var/www/html
COPY . /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copiar configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Puerto Railway
ENV PORT 8080
EXPOSE 8080

# Arranque seguro: PHP-FPM en background + Nginx en foreground
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]
