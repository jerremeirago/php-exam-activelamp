FROM php:8-apache

RUN apt-get update \
 && apt-get install -y git zlib1g-dev libzip-dev libicu-dev libtidy-dev  \
 && docker-php-ext-configure intl \
 && docker-php-ext-install zip intl pdo_mysql mysqli tidy \
 && a2enmod rewrite \
 && mv /var/www/html /var/www/public

RUN curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer

RUN git config --global user.name "jerremeirago" \
  && git config --global user.email "jrago@melistechnology.com" \
  && apt-get install unzip \
  && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" 


RUN mkdir /var/www/html/lbpam

WORKDIR /var/www/html/

# mail hog , fake smtp
RUN apt-get install wget -y \
 && wget https://github.com/mailhog/mhsendmail/releases/download/v0.2.0/mhsendmail_linux_amd64 \
 && chmod +x mhsendmail_linux_amd64 \
 && mv mhsendmail_linux_amd64 /usr/local/bin/mhsendmail

COPY /docker/php.ini /usr/local/etc/php/php.ini

RUN a2enmod headers \
 && service apache2 restart 

RUN apt-get install -y libxml2-dev \
 && docker-php-ext-install dom 

COPY /docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN chmod -R 0777 .
