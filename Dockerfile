FROM php:7.4-apache

COPY php.ini /usr/local/etc/php/
COPY 000-default.conf /etc/apache2/sites-available/

RUN apt-get update && \
    apt-get install --no-install-recommends -y zlib1g-dev libc-client-dev libkrb5-dev libfreetype6-dev libzip-dev libjpeg62-turbo-dev libpng-dev libxml2-dev cron rsyslog zip unzip socat vim nano && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install imap exif mysqli pdo pdo_mysql zip gd xml

RUN cd /var/www/html && \
    # Link for Version 7.4.0 (change below if other version is needed)
    curl -o vtiger.tar.gz -L "https://sourceforge.net/projects/vtigercrm/files/vtiger%20CRM%207.4.0/Core%20Product/vtigercrm7.4.0.tar.gz" && \
    tar -xzf vtiger.tar.gz && \
    rm vtiger.tar.gz && \
    chmod -R 777 .
    # mkdir /var/lib/vtiger/logs && \
    # chmod -R 777 /var/lib/vtiger/logs

WORKDIR /app