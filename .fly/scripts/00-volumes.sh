

# echo "Current directory: $(pwd)"
# echo "Contents of /var/lib/sqlite:"
# ls -la /var/lib/sqlite

# if [ ! -d "/var/lib/sqlite" ]; then
#     echo "Creating /var/lib/sqlite directory..."
#     mkdir -p /var/lib/sqlite
#     chown www-data:www-data /var/lib/sqlite
#     chmod 775 /var/lib/sqlite
# fi

# if [ ! -f /var/lib/sqlite/database.sqlite ]; then
#     echo "Production database not found. Copying the pre-filled database..."
#     if [ -f /var/www/html/database/database.sqlite ]; then
#         cp /var/www/html/database/database.sqlite /var/lib/sqlite/database.sqlite
#         echo "Pre-filled database copied successfully."
#     else
#         echo "Error: Pre-filled database file not found. Creating an empty database."
#         touch /var/lib/sqlite/database.sqlite
#     fi
# else
#     echo "Production database already exists. Skipping copy."
# fi

# chown www-data:www-data /var/lib/sqlite/database.sqlite
# chmod 664 /var/lib/sqlite/database.sqlite

# echo "Setting directory permissions..."
# chown -R www-data:www-data /var/lib/sqlite
# chmod -R 775 /var/lib/sqlite

# echo "Running migrations to ensure database schema is up-to-date..."
# php /var/www/html/artisan migrate --force

# echo "Database setup completed."
