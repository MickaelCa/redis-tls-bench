#syntax=docker/dockerfile:1.4
FROM php:8.2-fpm-alpine

WORKDIR /benchmark

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

COPY --from=composer/composer:2-bin --link /composer /usr/bin/composer

# persistent / runtime deps
RUN set -eux; \
	apk add --no-cache \
		bash \
    ; \
# PHP Extensions
    install-php-extensions \
		redis \
    ;

ENV COMPOSER_ALLOW_SUPERUSER=1