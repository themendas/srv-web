
# =============================================================================
# themendas/srv-web
#
# CentOS-8, PHP-FPM 8.0
# 
# =============================================================================


FROM centos:8
MAINTAINER TheMendas <borjavilaplana@gmail.com>

##
## Labels
##
LABEL \
	name="themendas PHP-FPM 8.0 Image" \
	image="php-fmp-8.0" \
	vendor="themendas" \
	license="MIT" \
	build-date="2021-05-08"


##
## VARS
##

ENV container docker
ARG USER
ARG PASS
ARG UID
ARG GID

##
## UPDATE
##

RUN dnf update -y

##
## INSTALL
##

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
               npm \
               git \
    && dnf clean all \
    && rm -rf /var/cache/yum

#Open SSH Server
RUN dnf -y install openssh-server
RUN mkdir -p /var/run/sshd
RUN sed -ri 's/^#?PermitRootLogin\s+.*/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -ri 's/UsePAM yes/#UsePAM yes/g' /etc/ssh/sshd_config
RUN sed -ri 's/#UsePAM no/UsePAM no/g' /etc/ssh/sshd_config
RUN ssh-keygen -A

# Add composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

##
## Nginx User
##

RUN usermod -d /opt/app -s /bin/false nginx

RUN mkdir -p /run/php-fpm && \
    chown nginx:nginx /run/php-fpm

RUN mkdir -p /var/lib/php/session && \
    chown nginx:nginx /var/lib/php/session


##
## Add-User
##

RUN groupadd -g $GID $USER && \
    useradd -g $GID -u $UID -M -d /opt/app $USER && \
    usermod -a -G root $USER && \
    usermod -a -G $USER root && \
    echo 'imagar:1m4g4r' | chpasswd && \
    mkdir -p /home/$USER/.ssh && \
    chown -R $USER:$USER /home/$USER/.ssh && \
    chmod 700 /home/$USER/.ssh
    
##
## Copy Configuration
##

COPY ./.docker/php-fpm/php-fpm.conf /etc/php-fpm.conf
COPY ./.docker/php-fpm/www.conf /etc/php-fpm.d/www.conf
COPY ./.docker/php-fpm/php.ini /etc/php.ini


##
## Copy Code WEB
##

COPY ./app /opt/app/

expose 9000 22

##
## Bootstrap Scipts
##
COPY ./.docker/php-fpm/entrypoint.sh /

##
## Entrypoint
##
ENTRYPOINT ["/entrypoint.sh"]

##
## Directorio Trabajo
##
WORKDIR /opt/app/

