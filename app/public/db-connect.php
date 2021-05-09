<?php
$dbname = 'db_database';
$dbuser = 'us_bd';
$dbpass = 'p4SSw0rd!';
$dbhost = 'mysql';

$enlace = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$enlace) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Exito: Se realizo una conexion apropiada a MySQL! La base de datos ### $dbname ### es genial." . PHP_EOL;

mysqli_close($enlace);
?>