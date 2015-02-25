<?php 

session_start();

include_once "../config/conection.php";

if(isset($_POST['ingresar']))
{
    extract($_REQUEST);

    $personas = mysql_query("SELECT * FROM persona WHERE cedula != 00000000 ");
    $fecha = date("Y-m-d");
    while($persona = mysql_fetch_assoc($personas))
    {
        $cedula_persona = $persona['cedula'];
        $verificacion_asistencia = mysql_query("SELECT * FROM asistencia WHERE cedula = '$cedula_persona' AND fecha = '$fecha' ");
        if(mysql_num_rows($verificacion_asistencia) == 0)
        {
            $asistencia = mysql_query("INSERT INTO asistencia (cedula, fecha, verificacion_entrada, verificacion_salida) VALUES ('$cedula_persona','$fecha','Inasistente','Inasistente')");
        }

    }

    $usuario = mysql_real_escape_string($_POST['user']);
    $contrasena = mysql_real_escape_string($_POST['contrasena']);
    $contrasena = base64_encode($contrasena);

    $sql = mysql_query(" SELECT * FROM users WHERE user = '".$usuario."' AND password = '".$contrasena."' ")or die("Error al Validar la Contraseña");

    if ($row = mysql_fetch_assoc($sql)) 
    {
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['cedula_user'] = $row['cedula'];
        $_SESSION['user'] = $row['user'];
        $_SESSION['rol'] = $row['rol'];
        mysql_close($conection);
        header("Location:../");
    }
    else
    {
        $_SESSION['menssage'] = "El usuario ingresado no existe en el sistema";
        header("Location:../");
    }
}
else
{
    header("Location:../");
}


?>