<?php

session_start();
require("../config/conection.php");

extract($_REQUEST);

if(! isset($_SESSION['user']))
{
  header("Location:../");
}
//var_dump($_REQUEST);
if(isset($aceptar))
{
    $fecha_nacimiento = $ano_nac."/".$mes_nac."/".$dia_nac;

    $verificar_existencia = mysql_query("SELECT * FROM persona WHERE cedula = '$cedula' ");

    if(mysql_num_rows($verificar_existencia) == 0)
    {
        $data_persona = mysql_query("INSERT INTO persona (cedula, nombre, apellido, sexo, fecha_nac, grado_instruccion) VALUES ('$cedula','$nombre','$apellido','$sexo','$fecha_nacimiento','$grado_instruccion')");
        $password = base64_encode($cedula);
    }
    else
    {
        $_SESSION['menssage'] = "Ya existe una persona registrada en el sistema identificada con la cedula ".$cedula;
        
        if($categoria == "Administrativo")
            header("Location:../modulos/registro_administrativo.php");
        elseif($categoria == "Docente")
            header("Location:../modulos/registro_docente.php");
        elseif($categoria == "Obrero")
            header("Location:../modulos/registro_obrero.php");
        elseif($categoria == "Administrador")
            header("Location:../modulos/registro_administrador.php");

        die();
    }

    $_SESSION['menssage'] = "La persona se ha registrado satisfactoriamente.";

    if($categoria == "Administrativo")
    {
        $data_administrativo = mysql_query("INSERT INTO administrativo (cedula, turno, especialidad, area) VALUES ('$cedula','$turno','$especialidad','$area')");
        $user = mysql_query("INSERT INTO users (cedula, user, password, rol) VALUES ('$cedula','$cedula','$password', 3) ");
        header("Location:../modulos/registro_administrativo.php");
    }
    elseif($categoria == "Docente")
    {
        $data_docente = mysql_query("INSERT INTO docente (cedula, turno, especialidad, asignatura) VALUES ('$cedula','$turno','$especialidad','$asignatura')");
        $user = mysql_query("INSERT INTO users (cedula, user, password, rol) VALUES ('$cedula','$cedula','$password', 2) ");
        header("Location:../modulos/registro_docente.php");
    }
    elseif($categoria == "Obrero")
    {
        $data_obrero = mysql_query("INSERT INTO docente (cedula, turno, area) VALUES ('$cedula','$turno','$area')");
        $user = mysql_query("INSERT INTO users (cedula, user, password, rol) VALUES ('$cedula','$cedula','$password', 4) ");
        header("Location:../modulos/registro_obrero.php");
    }
    elseif($categoria == "Administrador")
    {
        $data_administrador = mysql_query("INSERT INTO users (cedula, user, password, rol) VALUES ('$cedula','$cedula','$password', 1) ");
        $_SESSION['menssage'] = "El administrador se ha registrado satisfactoriamente.";
        header("Location:../modulos/registro_administrador.php");
    }

    
    
}
else
{
    header("Location:../");
}