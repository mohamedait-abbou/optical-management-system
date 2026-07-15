FROM php:8.5-apache

# Install system dependencies required by Laravel & Vite
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache Rewrite Module (Required for Laravel routing)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install Node dependencies and build assets (Tailwind/Vite)
# If you want to build inside Docker, uncomment these lines:
# RUN npm install && npm run build

# Install PHP dependencies (optimized for production)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Generate Laravel App Key if not present (Crucial for first run)
RUN if [ ! -f .env ]; then cp .env.example .env; fi \
    && php artisan key:generate --force

# Set correct permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]