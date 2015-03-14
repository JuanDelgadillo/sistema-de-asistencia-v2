<?php

session_start();

include_once "../config/conection.php";
extract($_REQUEST);

if(isset($aceptar))
{
    $fecha_nacimiento = $ano_nac."/".$mes_nac."/".$dia_nac;

    if($cedula_get != $cedula)
    {
        $verificar_existencia = mysql_query("SELECT * FROM persona WHERE cedula = '$cedula' ");

        if(mysql_num_rows($verificar_existencia) != 0)
        {
            $_SESSION['menssage'] = "Ya existe una persona registrada en el sistema identificada con la cedula ".$cedula;
            
            if($categoria == "Administrativo")
                header("Location:../modulos/registro_administrativo.php?cedula=".$cedula_get);
            elseif($categoria == "Docente")
                header("Location:../modulos/registro_docente.php?cedula=".$cedula_get);
            elseif($categoria == "Obrero")
                header("Location:../modulos/registro_obrero.php?cedula=".$cedula_get);
            elseif($categoria == "Administrador")
                header("Location:../modulos/registro_administrador.php?cedula=".$cedula_get);

            die();
        }
    }

    $data_persona = mysql_query("UPDATE persona SET cedula = '$cedula', nombre = '$nombre', apellido = '$apellido', sexo = '$sexo', fecha_nac = '$fecha_nacimiento', grado_instruccion = '$grado_instruccion' WHERE cedula = '$cedula' ");

    if($categoria == "Docente")
    {
        $data_docente = mysql_query("UPDATE docente SET turno = '$turno', especialidad = '$especialidad', asignatura = '$asignatura' WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "Los datos del docente se actualizaron satisfactoriamente.";
        header("Location:../modulos/all_docentes.php");
    }
    elseif($categoria == "Administrativo")
    {
        $data_administrativo = mysql_query("UPDATE administrativo SET turno = '$turno', especialidad = '$especialidad', area = '$area' WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "Los datos del administrativo se actualizaron satisfactoriamente.";
        header("Location:../modulos/all_administrativos.php");
    }
    elseif($categoria == "Obrero")
    {
        $data_obrero = mysql_query("UPDATE obrero SET turno = '$turno', area = '$area' WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "Los datos del obrero se actualizaron satisfactoriamente.";
        header("Location:../modulos/all_obreros.php");
    }
    elseif($categoria == "Administrador")
    {
        //var_dump($_REQUEST);
        $password = base64_encode($password);
        $data_administrador = mysql_query("UPDATE users SET user = '$user', password = '$password' WHERE cedula = '$cedula' ");
        $_SESSION['menssage'] = "Los datos del usuario se actualizaron satisfactoriamente.";
        header("Location:../modulos/all_administradores.php");
    }


}
else
{
    header("Location:../");
}