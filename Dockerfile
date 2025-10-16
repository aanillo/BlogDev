# Usamos PHP 8.2 con FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema y extensiones PHP necesarias
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

# Copiar el proyecto al contenedor
WORKDIR /var/www/html
COPY . /var/www/html

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copiar configuración de Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Puerto asignado por Railway
ENV PORT 8080
EXPOSE 8080

# Iniciar Nginx + PHP-FPM
CMD service php8.2-fpm start && nginx -g "daemon off;"
