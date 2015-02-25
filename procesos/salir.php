<?php 

session_start();

include_once "../config/conection.php";

if(isset($_SESSION['user']))
{
    session_destroy();
    header("Location:../");
}
else
{
    header("Location:../");
}


?>