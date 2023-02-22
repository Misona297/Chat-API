FROM php:7.4.33-fpm

RUN apt-get update && apt-get install -y \
        --no-install-recommends libfontconfig1 libxrender1 zlib1g-dev libxml2-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng12.0 libmagickwand-dev imagemagick curl openssl libssl-dev libcurl4-openssl-dev zip libzip-dev unzip git \
        && rm -r /var/lib/apt/lists/* \
		&& docker-php-ext-configure zip \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) zip gd opcache pdo_mysql gettext sockets

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN pecl install imagick \
	&& docker-php-ext-enable imagick;

#composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

#node 16
RUN curl -sL https://deb.nodesource.com/setup_16.x -o nodesource_setup.sh && bash nodesource_setup.sh && apt-get -y --force-yes install nodejs
