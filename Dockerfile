FROM php:8.5-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libxml2-dev \
    libonig-dev \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        zip \
        bcmath \
        gd \
        xml \
        mbstring \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Fix composer git operations on self-hosted runner
RUN git config --global --add safe.directory '*'

WORKDIR /var/www/html

# Copy pre-built application (vendor, node_modules, built assets all included)
COPY . .

EXPOSE 80

CMD ["apache2-foreground"]
