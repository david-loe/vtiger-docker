FROM php:7.4-apache

WORKDIR /app

RUN apt-get update && \
    apt-get install --no-install-recommends -y zlib1g-dev libc-client-dev libkrb5-dev libfreetype6-dev libzip-dev libjpeg62-turbo-dev libpng-dev libxml2-dev cron rsyslog zip unzip socat vim nano && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-configure imap --with-kerberos --with-imap-ssl && \
    docker-php-ext-install imap exif mysqli pdo pdo_mysql zip gd xml

RUN cd /var/www/html && \
    # Link for Version 7.4.0 (change below if other version is needed)
    curl -o vtiger.tar.gz -L "https://sourceforge.net/projects/vtigercrm/files/vtiger%20CRM%207.4.0/Core%20Product/vtigercrm7.4.0.tar.gz" && \
    tar -x -z --skip-old-files -f vtiger.tar.gz && \
    rm vtiger.tar.gz && \
    chmod -R 777 .
    # mkdir /var/lib/vtiger/logs && \
    # chmod -R 777 /var/lib/vtiger/logs

COPY vtiger-cron /etc/cron.d/vtiger-cron

RUN chmod 0644 /etc/cron.d/vtiger-cron && \
    chmod 0744 /var/www/html/vtigercrm/cron/vtigercron.sh && \
    touch /var/log/cron.log && \
    chmod 777 /var/log/cron.log && \
    crontab /etc/cron.d/vtiger-cron

COPY php.ini /usr/local/etc/php/
COPY 000-default.conf /etc/apache2/sites-available/


RUN sed -i 's/^exec /service cron start\n\nexec /' /usr/local/bin/apache2-foreground