FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libwebp-dev libzip-dev \
    libfreetype6-dev default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd mysqli zip exif opcache

# Remove ALL MPM modules, re-enable only prefork
RUN find /etc/apache2/mods-enabled -name 'mpm_*' -delete \
    && a2enmod mpm_prefork rewrite

# Apache listens on PORT env var
RUN echo 'Listen ${APACHE_PORT}' > /etc/apache2/ports.conf

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod +x /var/www/html/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/var/www/html/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
