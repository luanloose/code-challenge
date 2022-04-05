FROM webdevops/php-dev:8.1

ENV XDEBUG_MODE=coverage

WORKDIR /app

COPY ./ /app

RUN composer install

USER application