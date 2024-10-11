#!/usr/bin/env bash
echo "Updating storage with latest content"
rsync -a --delete /var/www/html/storage_/ /var/www/html/storage/
echo "Setting permissions"
chown -R www-data:www-data /var/www/html/storage
