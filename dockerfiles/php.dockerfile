FROM php:8-fpm-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

# Combine directory creation and user/group
RUN mkdir -p /var/www/html \
    && addgroup -g ${GID} --system laravel \
    && adduser -G laravel --system -D -s /bin/sh -u ${UID} laravel

WORKDIR /var/www/html

# Use the stable Composer version
COPY --from=composer:2.6 /usr/bin/composer /usr/local/bin/composer

# RUN sed and php-fpm configuration into a single
RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Install PHP extensions
# RUN docker-php-ext-install pdo pdo_mysql \
#    && mkdir -p /usr/src/php/ext/redis \
#    && curl -L https://github.com/phpredis/phpredis/archive/5.3.4.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
#    && docker-php-ext-install redis

RUN docker-php-ext-install pdo_mysql

# Install necessary packages and extensions
RUN apk add --no-cache --virtual .build-deps \
        autoconf \
        g++ \
        make \
        curl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

USER laravel

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]