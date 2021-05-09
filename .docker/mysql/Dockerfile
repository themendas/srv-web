# =============================================================================
# themendas/srv-web
#
# OracleLinux, Mysql-8
# 
# =============================================================================

FROM oraclelinux:8-slim
MAINTAINER TheMendas <borjavilaplana@gmail.com>
ENV container docker

##
## Labels
##
LABEL \
	name="themendas MySQL 8.0 Image" \
	image="mysql-8.0.24" \
	vendor="themendas" \
	license="MIT" \
	build-date="2021-05-08"

##
## Variables
##
 
ARG MYSQL_SERVER_PACKAGE=mysql-community-server-minimal-8.0.24
ARG MYSQL_SHELL_PACKAGE=mysql-shell-8.0.24

##
## ADD REPO
##
# Setup repositories for minimal packages (all versions)
RUN rpm -U https://repo.mysql.com/mysql-community-minimal-release-el8.rpm \
  && rpm -U https://repo.mysql.com/mysql80-community-release-el8.rpm


##
## ADD REPO
##
# Install server and shell 8.0
RUN microdnf update && echo "[main]" > /etc/dnf/dnf.conf \
  && microdnf install -y $MYSQL_SHELL_PACKAGE \
  && microdnf install -y --disablerepo=ol8_appstream \
   --enablerepo=mysql80-server-minimal $MYSQL_SERVER_PACKAGE \
  && microdnf clean all \
  && mkdir /docker-entrypoint-initdb.d


##
## Configure
##
COPY .docker/mysql/prepare-image.sh /
RUN /prepare-image.sh && rm -f /prepare-image.sh

ENV MYSQL_UNIX_PORT /var/lib/mysql/mysql.sock

COPY .docker/mysql/entrypoint.sh /entrypoint.sh
COPY .docker/mysql/healthcheck.sh /healthcheck.sh
HEALTHCHECK CMD /healthcheck.sh
EXPOSE 3306 33060 33061




##
## Entrypoint
##
ENTRYPOINT ["/entrypoint.sh"]
CMD ["mysqld"]
