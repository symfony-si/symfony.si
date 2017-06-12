FROM phpearth/php:7.1-nginx

RUN install-php-ext swoole \
    && install-composer -p \
    && apk --no-cache add git \
    && sed -ri 's/^www-data:x:82:82:/www-data:x:1000:50:/' /etc/passwd

COPY .docker/app/ /
