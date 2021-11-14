FROM php:7.4-apache
RUN apt-get update && apt-get install -y libzip-dev zip curl
RUN docker-php-ext-install mysqli pdo pdo_mysql zip && docker-php-ext-enable mysqli pdo_mysql && a2enmod rewrite
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html
ENTRYPOINT ["bash","entrypoint.sh"]
CMD ["apache2-foreground"]