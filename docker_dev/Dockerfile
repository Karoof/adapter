FROM php:7.3-fpm

# Install selected extensions and other stuff
RUN apt-get update && apt-get install -y zlib1g-dev git g++ libicu-dev zip libzip-dev zip \
    && docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu xdebug redis \
    && docker-php-ext-enable apcu xdebug redis \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

WORKDIR /app


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

COPY . /app
