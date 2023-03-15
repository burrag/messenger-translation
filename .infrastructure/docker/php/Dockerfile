FROM php:8.2.3-fpm-buster

RUN apt update && apt -y install \
  zlib1g-dev \
  libjpeg-dev \
  libpng-dev \
  libfreetype6-dev \
  libbz2-dev \
  libicu-dev \
  libpq-dev \
  libxml2-dev \
  libxslt-dev \
  libzip-dev \
  libgmp-dev \
  libfcgi \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j "$(nproc)" exif pcntl bcmath bz2 calendar intl pdo_pgsql pgsql soap xsl zip gmp gd \
  && pecl install xdebug && docker-php-ext-enable xdebug

COPY ./.infrastructure/docker/php/php.ini /usr/local/etc/php/conf.d/custom_php.ini
COPY ./.infrastructure/docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html
