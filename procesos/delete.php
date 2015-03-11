<?php

session_start();

include_once "../config/conection.php";
extract($_REQUEST);

if(isset($cedula))
{
    if($categoria == "Docente")
    {
        $delete = mysql_query("DELETE FROM persona WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "El Docente ha sido eliminado satisfactoriamente.";
        header("Location:../modulos/all_docentes.php");
    }
    elseif($categoria == "Administrativo")
    {
        $delete = mysql_query("DELETE FROM persona WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "El Administrativo ha sido eliminado satisfactoriamente.";
        header("Location:../modulos/all_administrativos.php");
    }
    elseif($categoria == "Obrero")
    {
        $delete = mysql_query("DELETE FROM persona WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "El Obrero ha sido eliminado satisfactoriamente.";
        header("Location:../modulos/all_obreros.php");
    }
    elseif($categoria == "Usuario")
    {
        $delete = mysql_query("DELETE FROM persona WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "El usuario ha sido eliminado satisfactoriamente.";
        header("Location:../modulos/all_administradores.php");
    }
}
else
{
    header("Location:../");
}