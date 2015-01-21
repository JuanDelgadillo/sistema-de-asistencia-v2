<?php 

session_start();

include_once "../config/conection.php";

if(isset($_POST['ingresar']))
{
    extract($_REQUEST);

    $usuario = mysql_real_escape_string($_POST['user']);
    $contrasena = mysql_real_escape_string($_POST['contrasena']);
    $contrasena = base64_encode($contrasena);

    $sql = mysql_query(" SELECT * FROM registro WHERE usuario = '".$usuario."' AND contrasena = '".$contrasena."' ")or die("Error al Validar la Contraseña");

    if ($row = mysql_fetch_assoc($sql)) 
    {
        $_SESSION['id_registro'] = $row['id_registro'];
        $_SESSION['usuario'] = $row['usuario'];
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