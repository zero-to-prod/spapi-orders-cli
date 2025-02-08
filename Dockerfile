FROM php:8.2-alpine AS builder

WORKDIR /app

RUN apk add --no-cache \
    git \
    unzip

COPY composer.json /app/

RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

RUN composer update --no-dev --prefer-dist --optimize-autoloader --no-interaction

COPY . /app

RUN chmod +x /app/bin/:slug

FROM php:8.2-alpine

WORKDIR /app

COPY --from=builder /app /app

ENTRYPOINT ["php", "bin/:slug", "--ansi"]