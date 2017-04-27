FROM phpearth/php:alpine

RUN apk --no-cache add git \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && composer global require hirak/prestissimo \
    && sed -ri 's/^www-data:x:82:82:/www-data:x:1000:50:/' /etc/passwd

COPY .docker/app/ /
