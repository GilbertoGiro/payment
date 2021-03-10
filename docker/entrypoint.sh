#!/usr/bin/env sh

# Copy environment file
echo "===> Copying environment file"
cp /opt/payment/.env.example /opt/payment/.env

# Run composer install
echo "===> Running composer"
composer install --no-interaction

# Run supervisor
echo "===> Running supervisor"
/usr/bin/supervisord -n
