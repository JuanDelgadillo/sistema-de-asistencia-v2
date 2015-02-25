<?php

$host = "localhost";
$user = "root";
$pass = "salomon";
$sdb = "sistema_asistencia";

$conex = mysql_connect($host,$user,$pass)
or die("No ha sido posible la coneccion al Servidor ".$host);
$db = mysql_select_db($sdb,$conex)
or die("No Se Encontro la base de datos ".$sdb);

?>