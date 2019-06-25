FROM nimmis/apache

MAINTAINER lazypeople <hfutming@gmail.com>

# disable interactive functions
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && \
apt-get install -y php libapache2-mod-php \
php-fpm php-cli php-mysqlnd php-pgsql php-sqlite3 php-redis php-memcached \
php-xml php-zip \
php-apcu php-intl php-imagick php-mcrypt php-json php-gd php-curl php-mbstring && \
phpenmod mcrypt && \
rm -rf /var/lib/apt/lists/* && \
cd /tmp && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN composer config -g repo.packagist composer https://packagist.laravel-china.org

COPY . /var/www/html_start
COPY 000-default.conf /etc/apache2/sites-available

# clear default index page
RUN rm -rf /var/www/html_start/index.html
RUN rm -rf /var/www/html_start/Dockerfile
# hide git info
RUN rm -rf /var/www/html_start/.git
RUN rm -rf /var/www/html_start/000-default.conf
RUN rm -rf /var/www/html_start/.idea
RUN rm -rf /var/www/html_start/.stfolder
RUN rm -rf /var/www/html_start/docker-entrypoint.sh

RUN chmod 777 -R /var/www/html/

# UPDATE PHP.INI
RUN sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 20M/' /etc/php/7.0/apache2/php.ini
RUN sed -i 's/post_max_size = 8M/post_max_size = 20M/' /etc/php/7.0/apache2/php.ini
RUN sed -i 's/max_execution_time = 30/max_execution_time = 300/' /etc/php/7.0/apache2/php.ini

RUN sed -i 's/auto_prepend_file =/auto_prepend_file ="\/var\/www\/html\/sae_auto_prepend.php"/' /etc/php/7.0/apache2/php.ini

ENV TIMEZONE="Etc/GMT+8"

COPY ./docker-entrypoint.sh /

RUN chmod +x /docker-entrypoint.sh

ENTRYPOINT ["/docker-entrypoint.sh"]

CMD ["/my_init"]