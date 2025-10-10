# Etapa 1: PHP + Composer
FROM php:8.2-fpm AS build

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring xml ctype bcmath zip curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar archivos de Laravel
WORKDIR /var/www/html
COPY . .

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Etapa 2: Nginx + PHP-FPM
FROM nginx:stable

# Copiar configuración personalizada de NGINX
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copiar la aplicación Laravel desde la etapa anterior
COPY --from=build /var/www/html /var/www/html

WORKDIR /var/www/html

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
