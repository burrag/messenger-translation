FROM nginx:alpine

ARG PHP_FPM_ENV

COPY .infrastructure/docker/nginx/php-fpm/$PHP_FPM_ENV.conf /etc/nginx/fpm_host.conf

COPY .infrastructure/docker/nginx/default.conf /etc/nginx/conf.d/default.conf
