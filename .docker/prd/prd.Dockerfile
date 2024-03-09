FROM php:8.3-fpm

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libpq-dev \
    postgresql-server-dev-all \
    && docker-php-ext-install pdo_pgsql pgsql zip bcmath sockets pcntl \
    && pecl install swoole \
    && docker-php-ext-enable swoole

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/app

COPY . /var/www/app

WORKDIR /var/www/app/src
RUN composer install --no-interaction --no-dev --optimize-autoloader


EXPOSE 9501
CMD ["php", "/var/www/app/src/bin/hyperf.php", "start"]
