#!/bin/bash

# Configurar Nginx para usar el puerto de Render
sed -i "s/listen 8080;/listen $PORT;/g" /etc/nginx/sites-available/default

# Iniciar PHP-FPM en segundo plano
php-fpm -D

# Configurar permisos de storage
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Iniciar Nginx en primer plano
nginx -g 'daemon off;'