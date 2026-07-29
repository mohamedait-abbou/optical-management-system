FROM php:8.5-apache

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

RUN git config --global --add safe.directory '*'

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --no-progress

COPY package.json package-lock.json ./
RUN npm ci

COPY . .

RUN npm run build

RUN rm -rf node_modules

EXPOSE 80

CMD ["apache2-foreground"]
