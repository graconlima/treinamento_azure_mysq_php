FROM php:7.1-apache
COPY ./ /var/www/html
EXPOSE 80
RUN docker-php-ext-install mysqli
CMD ["apache2-foreground"]

