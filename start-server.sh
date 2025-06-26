#!/bin/bash

# Jalankan Laravel setup
php artisan migrate --force
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Jalankan Laravel dengan PHP built-in server
php -S 0.0.0.0:${PORT:-9000} -t public
