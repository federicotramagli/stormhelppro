FROM wordpress:php8.2-apache

RUN apt-get update && apt-get install -y default-mysql-client && rm -rf /var/lib/apt/lists/*

COPY wp-content/ /var/www/html/wp-content/
COPY wp-config.php /var/www/html/wp-config.php
COPY stormhelppro_com-2026-04-10-e1ea6b5.sql /tmp/wordpress-import.sql
COPY docker-entrypoint.sh /docker-entrypoint-custom.sh
RUN chmod +x /docker-entrypoint-custom.sh

ENTRYPOINT ["/docker-entrypoint-custom.sh"]
CMD ["apache2-foreground"]
