# =============================================================================
# themendas/srv-web
#
# CentOS-8, Mysql-8
# 
# =============================================================================

FROM centos:8
MAINTAINER TheMendas <borjavilaplana@gmail.com>
ENV container docker

##
## Labels
##
LABEL \
	name="themendas MySQL 8.0 Image" \
	image="mysql-8.0.21/1" \
	vendor="themendas" \
	license="MIT" \
	build-date="2021-05-08"
 
# User/Group
ENV MY_USER="mysql"
ENV MY_GROUP="mysql"
ENV MY_UID="48"
ENV MY_GID="48"

# Files
ENV MYSQL_DATA_DIR="/var/lib/mysql" \
    MYSQL_RUN_DIR="/run/mysqld" \
    MYSQL_LOG_DIR="/var/log/mysql" \
    MYSQL_SCK_DIR="/var/sock/mysqld" \
    MYSQL_CUST_DIR="/etc/my.cnf.d"

###
### Install
###
RUN groupadd -g ${MY_GID} -r ${MY_GROUP} && \
	adduser ${MY_USER} -u ${MY_UID} -M -s /sbin/nologin -g ${MY_GROUP}


RUN dnf update -y && \
    dnf install -y mysql-server

RUN dnf install -y nginx \
    && dnf clean all \
    && rm -rf /var/cache/yum
    
##
## Configure
##
RUN \
	chown -R ${MY_USER}:${MY_GROUP} ${MYSQL_DATA_DIR} && \
	chown -R ${MY_USER}:${MY_GROUP} ${MYSQL_RUN_DIR} && \
	chown -R ${MY_USER}:${MY_GROUP} ${MYSQL_LOG_DIR}

RUN \
	echo "[client]"                                         > /etc/my.cnf && \
	echo "socket = ${MYSQL_SCK_DIR}/mysqld.sock"           >> /etc/my.cnf && \
	\
	echo "[mysql]"                                         >> /etc/my.cnf && \
	echo "socket = ${MYSQL_SCK_DIR}/mysqld.sock"           >> /etc/my.cnf && \
	\
	echo "[mysqld]"                                        >> /etc/my.cnf && \
	echo "skip-host-cache"                                 >> /etc/my.cnf && \
	echo "skip-name-resolve"                               >> /etc/my.cnf && \
	echo "datadir = ${MYSQL_DATA_DIR}"                      >> /etc/my.cnf && \
	echo "user = ${MY_USER}"                               >> /etc/my.cnf && \
	echo "port = 3306"                                     >> /etc/my.cnf && \
	echo "bind-address = 0.0.0.0"                          >> /etc/my.cnf && \
	echo "socket = ${MYSQL_SCK_DIR}/mysqld.sock"           >> /etc/my.cnf && \
	echo "pid-file = ${MYSQL_RUN_DIR}/mysqld.pid"          >> /etc/my.cnf && \
	echo "!includedir ${MYSQL_CUST_DIR}/"                  >> /etc/my.cnf && \
	echo "log-error = ${MYSQL_LOG_DIR}"                    >> /etc/my.cnf


##
## Bootstrap Scipts
##
COPY ./.docker/mysql/entrypoint.sh /


##
## Ports
##
EXPOSE 3306

##
## Volumes
##
VOLUME ${MYSQL_DATA_DIR}
VOLUME /etc/mysql/conf.d

##
## Entrypoint
##
ENTRYPOINT ["/entrypoint.sh"]
