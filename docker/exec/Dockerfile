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

# Install nodjs (used in yarn)
ARG NODE_VERSION=8.15.1
RUN set -xe \
	&& buildDeps="xz-utils" && ARCH="x64" \
	&& apt-get update && apt-get install -y --no-install-recommends ca-certificates curl wget dirmngr $buildDeps \
	&& curl -fsSLO --compressed "https://nodejs.org/dist/v${NODE_VERSION}/node-v${NODE_VERSION}-linux-${ARCH}.tar.xz" \
	&& tar -xJf "node-v${NODE_VERSION}-linux-${ARCH}.tar.xz" -C /usr/local --strip-components=1 --no-same-owner \
	&& rm "node-v${NODE_VERSION}-linux-${ARCH}.tar.xz" \
	&& ln -s /usr/local/bin/node /usr/local/bin/nodjs \
	&& apt-get purge -y --auto-remove $buildDepts \
	&& rm -rf /var/lib/apt/lists/*

# Install yarn (used in symfony encore)
ARG YARN_VERSION=1.15.2
RUN set -xe \
	&& curl -fsSLO --compressed "https://yarnpkg.com/downloads/${YARN_VERSION}/yarn-v${YARN_VERSION}.tar.gz" \
	&& tar -xzf "yarn-v${YARN_VERSION}.tar.gz" -C /opt/ \
	&& ln -s "/opt/yarn-v${YARN_VERSION}/bin/yarn" /usr/local/bin/yarn \
	&& ln -s "/opt/yarn-v${YARN_VERSION}/bin/yarnpkg" /usr/local/bin/yarnpkg \
	&& rm "yarn-v${YARN_VERSION}.tar.gz"

VOLUME /app
WORKDIR /app

RUN set -xe \
	&& mkdir /.composer /.cache /.yarn \
	&& chmod 777 /.composer /.cache /.yarn

CMD ["sleep", "365d"]
