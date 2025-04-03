FROM php:8.2-apache

RUN a2enmod rewrite headers && \
    apt-get update && \
    apt-get install -y libsqlite3-dev && \
    docker-php-ext-install pdo_sqlite

COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php/php.ini /usr/local/etc/php/conf.d/

COPY src/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    mkdir -p /var/www/html/data && \
    chmod 775 /var/www/html/data

WORKDIR /var/www/html