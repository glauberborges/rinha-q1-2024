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

## Development
RUN apt-get update && apt-get install -y wget \
&& wget https://github.com/emcrisostomo/fswatch/releases/download/1.14.0/fswatch-1.14.0.tar.gz \
&& tar -xf fswatch-1.14.0.tar.gz \
&& cd fswatch-1.14.0/ \
&& ./configure \
&& make \
&& make install

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p /var/www/app
WORKDIR /var/www/app

COPY . /var/www/app

WORKDIR /var/www/app/src
RUN composer install --no-interaction --no-dev --optimize-autoloader

EXPOSE 9501

# Comando para iniciar o servidor Hyperf quando o container é iniciado
CMD ["php", "bin/hyperf.php", "server:watch"]
