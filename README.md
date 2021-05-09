# CentOS 8: Nginx, php-fpm (con-ssh), mysql

## COMPOSICION

Se compone de tres contenedores con los siguientes contenidos:

**NGINX 1.14 Docker on CentOS 8**

 Servidor NGINX con Reverse Proxy a PHP-FPM
 
**PHP FPM 8.0 Docker on CentOS 8**

 Servidor PHP-FPM con los siguientes opciones:
  - Composer
  - NPM
  - SSH Exec

**MySQL 8.0 Docker on OracleLinux 8 **

 Servidor Oracle Linux con Mysql Server 8

## Directorios

| DIR | Description |
|----------|-------------|
| SSH DIR  | /opt/app |
| WEB  | /opt/app/public |

## Options

Leera todas las variables del archivo .env (renombrar archivo .env-example)

### Variables de Imagen

| Variable | Description |
|----------|-------------|
| APP_NAME  | Nombre de aplicacion, para nombre de contenedor |
| WEB_FQDN  | Nombre de dominio virtualhost, para nombre en nginx |
| SFTP_USER | Usuario para conexion SSH |
| SFTP_PASS | Password para el usuario SSH |
| SFTP_UID  | UID del usuario nuevo SSH |
| SFTP_GID  | GUID del usuario nuevo SSH |
| MYSQL_DATABASE  | Nombre de la base de datos |
| MYSQL_USER  | Nombre del usuario para la base de datos |
| MYSQL_PASSWORD  | Contraseña del usuario para la base de datos |
| MYSQL_ROOT_PASSWORD  | Password root del servidor MYSQL |
| PORT_NGINX  | Puereto publicado para el NGINX |
| PORT_SSH  | Puerto publicado para conexion SSH |
| PORT_MYSQL  | Puerto publicado para el MYSQL |


## INICIAR

```
docker-compose -f docker-compose.yml up
```

Para el acceso a la web de ejemplo: http://localhost
