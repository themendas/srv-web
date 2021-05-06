# =============================================================================
# themendas/centos-nginx-php
#
# CentOS-8, Nginx
# =============================================================================


FROM centos:8
MAINTAINER TheMendas <borjavilaplana@gmail.com>
ENV container docker

RUN dnf update -y && \
    dnf install -y epel-release

RUN dnf install -y nginx \
    && dnf clean all \
    && rm -rf /var/cache/yum
    

COPY ./.docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./.docker/nginx/app.conf /etc/nginx/conf.d/app.conf

expose 80
CMD nginx
WORKDIR /opt/app/