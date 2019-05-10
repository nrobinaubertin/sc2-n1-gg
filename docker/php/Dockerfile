FROM php:7.3-fpm-stretch

ARG XDEBUG_VERSION=2.7.0
RUN set -xe \
    && buildDepts="g++" \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        $buildDeps \
        libicu-dev \
        libpcre3-dev \
        libpq-dev \
        libxml2-dev \
        libzip-dev \
        zlib1g-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install mbstring zip soap pdo_pgsql intl opcache \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
    && apt-get purge -y --auto-remove $buildDeps \
    && rm -rf /var/lib/apt/lists/*
