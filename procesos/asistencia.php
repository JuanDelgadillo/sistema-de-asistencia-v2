<?php

session_start();

include_once "../config/conection.php";

extract($_REQUEST);

if(isset($cedula))
{
    $fecha = date("Y-m-d");

    //var_dump($_REQUEST);
    
    if($asistencia == "Entrada")
    {
        $asistenciaEntrada = mysql_query("UPDATE asistencia SET fecha_hora_entrada = NOW(), verificacion_entrada = 'Asistencia' WHERE cedula = '$cedula' AND fecha = '$fecha' ");
    }
    elseif($asistencia == "Salida")
    {
        $asistenciaEntrada = mysql_query("UPDATE asistencia SET fecha_hora_salida = NOW(), verificacion_salida = 'Asistencia' WHERE cedula = '$cedula' AND fecha = '$fecha' ");
    }
    
    $_SESSION['menssage'] = "La asistencia ha sido registrada satisfactoriamente.";


    if($asistencia == "Entrada")
    {
        header("Location:../");
    }
    elseif($asistencia == "Salida")
    {
        header("Location:../");
    }
    else
    {
        // unset($_SESSION['proceso']);
        // unset($_SESSION['cedula_persona']);
        // header("Location:../modulos/asistencia.php");
    }
}
else
{
    header("Location:../");
}
