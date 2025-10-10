# Etapa 1: Build de Laravel
FROM php:8.2-fpm AS builder

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    default-mysql-client \
    && docker-php-ext-install pdo pdo_mysql mbstring xml ctype bcmath zip curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar proyecto al contenedor
WORKDIR /var/www/html
COPY . /var/www/html

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Generar APP_KEY (si no está en .env)
RUN php artisan key:generate

# Ejecutar migraciones automáticamente
RUN php artisan migrate --force

# Opcional: ejecutar seeders si quieres cargar datos iniciales
# RUN php artisan db:seed --force

# Ajustar permisos de carpetas críticas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Etapa 2: Imagen final con NGINX
FROM nginx:stable-alpine

# Copiar la app desde la etapa builder
COPY --from=builder /var/www/html /var/www/html

# Copiar configuración de NGINX
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Exponer puerto 80
EXPOSE 80

# Iniciar NGINX en primer plano
CMD ["nginx", "-g", "daemon off;"]
