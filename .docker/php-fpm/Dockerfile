
# =============================================================================
# themendas/centos-nginx-php
#
# CentOS-8, PHP-FPM 8.0
# 
# =============================================================================



FROM centos:8
MAINTAINER TheMendas <borjavilaplana@gmail.com>
ENV container docker

# Instalar PHP 8
RUN dnf -y install epel-release \
    && dnf -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm  \
    && dnf module -y install php:remi-8.0 \
    && dnf -y install dnf-plugins-core
ENV ACCEPT_EULA=Y


RUN dnf -y install php \
               php-fpm \
               php-common \
               php-mbstring \
               php-soap \
               php-pear \
               php-xml \
               php-mysqlnd \
               php-xmlrpc \   
               php-gd \
               php-intl \
               php-json \
               php-opcache \
               php-pdo \
               php-bcmath \
               php-pecl-uuid \
               php-pecl-zip \
               php-pecl-memcached \
               php-pecl-imagick \
    && dnf clean all \
    && rm -rf /var/cache/yum

RUN usermod -d /opt/app -s /bin/false nginx

RUN mkdir -p /run/php-fpm && \
    chown nginx:nginx /run/php-fpm

RUN mkdir -p /var/lib/php/session && \
    chown nginx:nginx /var/lib/php/session

COPY ./.docker/php-fpm/php-fpm.conf /etc/php-fpm.conf
COPY ./.docker/php-fpm/www.conf /etc/php-fpm.d/www.conf
COPY ./.docker/php-fpm/php.ini /etc/php.ini

expose 9000

CMD php-fpm
WORKDIR /opt/app/
