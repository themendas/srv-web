# =============================================================================
# themendas/srv-web
#
# CentOS-8, Nginx
# =============================================================================


FROM centos:8
MAINTAINER TheMendas <borjavilaplana@gmail.com>
ENV container docker

##
## Labels
##
LABEL \
	name="themendas NGINX 8.0 Image" \
	image="nginx-1.14.1" \
	vendor="themendas" \
	license="MIT" \
	build-date="2021-05-08"


###
### UPDATE
###
RUN dnf update -y && \
    dnf install -y epel-release


###
### Install
###
RUN dnf install -y nginx \
    && dnf clean all \
    && rm -rf /var/cache/yum
    
###
### CONFIGURE
###
COPY ./.docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./.docker/nginx/app.conf /etc/nginx/conf.d/app.conf

expose 80

##
## Bootstrap Scipts
##
COPY ./.docker/nginx/entrypoint.sh /

##
## Entrypoint
##
ENTRYPOINT ["/entrypoint.sh"]

##
## Directorio Trabajo
##
WORKDIR /opt/app/