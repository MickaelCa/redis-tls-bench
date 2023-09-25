#syntax=docker/dockerfile:1.4
FROM php:8.2-fpm-alpine

WORKDIR /srv/app

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# persistent / runtime deps
RUN set -eux; \
	apk add --no-cache \
		bash \
    ; \
# PHP Extensions
    install-php-extensions \
		redis \
    ;