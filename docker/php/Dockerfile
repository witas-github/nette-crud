FROM php:8.1.0RC5-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
