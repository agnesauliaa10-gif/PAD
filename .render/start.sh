#!/bin/bash

# Caching Config
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migration
php artisan migrate --force

# Start Nginx
service nginx start

# Start PHP-FPM
php-fpm
