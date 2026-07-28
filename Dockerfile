FROM php:8.4-cli

# System dependencies + PHP extensions Laravel needs
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Node.js (needed to build Vite/Tailwind assets)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/html
COPY . .

# Install PHP + JS dependencies and build frontend assets
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

# Prepare SQLite database file + writable folders
RUN mkdir -p database \
    && touch database/database.sqlite \
    && chmod -R 775 storage bootstrap/cache database

EXPOSE 10000

# Run migrations then start the app. Render injects $PORT automatically.
CMD php artisan config:clear \
    && php artisan migrate --force \
    && (php artisan db:seed --force || true) \
    && php artisan serve --host 0.0.0.0 --port ${PORT:-10000}
