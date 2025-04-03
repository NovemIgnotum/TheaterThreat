FROM php:8.2-apache

# Installer les dépendances système pour SQLite
RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite

# Configuration PHP
COPY php/php.ini /usr/local/etc/php/conf.d/

# Configuration Apache
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copier l'application
COPY app/ /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html && \
    mkdir -p /var/www/html/database && \
    chown www-data:www-data /var/www/html/database

WORKDIR /var/www/html