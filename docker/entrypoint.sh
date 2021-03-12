#!/usr/bin/env sh

echo "===> Wait until mysql is ready"
/wait

# Apply necessary permissions for storage path
chmod -R 774 /opt/payment/storage

# Copy environment file
echo "===> Copying environment file"
cp /opt/payment/.env.example /opt/payment/.env

# Run composer install
echo "===> Running composer"
composer install --no-interaction

# Run migrations
echo "===> Running migrations"
php artisan migrate

# Run seeders
echo "===> Running seeders"
php artisan db:seed

# Run supervisor
echo "===> Running supervisor"
/usr/bin/supervisord -n
