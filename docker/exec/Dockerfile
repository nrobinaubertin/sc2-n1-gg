FROM alpine:3.9

VOLUME /data
WORKDIR /data

RUN set -xe && apk add --no-cache \
        php7 git zip unzip curl wget ca-certificates openssl \
        nodejs-npm gnupg sudo acl sqlite yarn bash postgresql-client
RUN set -xe && apk add --no-cache \
    php7-pdo_pgsql \
    php7-apcu \
    php7-common \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-fileinfo \
    php7-fpm \
    php7-gd \
    php7-iconv \
    php7-imagick \
    php7-intl \
    php7-json \
    php7-mbstring \
    php7-opcache \
    php7-openssl \
    php7-pdo_sqlite \
    php7-phar \
    php7-posix \
    php7-session \
    php7-simplexml \
    php7-tokenizer \
    php7-xml \
    php7-xmlwriter \
    php7-zip
RUN set -xe && apk add --no-cache rsync openssh

CMD ["sleep", "365d"]
