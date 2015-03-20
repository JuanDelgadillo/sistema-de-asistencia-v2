<?php  

include_once "../config/conection.php";

session_start();
extract($_REQUEST);
if(! isset($_SESSION['user']))
{
  header("Location:../");
}
    $classDocente = "";
    $classAdministrativo = "";
    $classObrero = "";

    if($categoria == "Administrativo") $classAdministrativo = "active";
    if($categoria == "Docente") $classDocente = "active";
    if($categoria == "Obrero") $classObrero = "active";
    
    if(isset($cedula))
    {
        $verificar_cedula = mysql_query("SELECT * FROM persona, users WHERE persona.cedula = '$cedula' AND users.cedula = persona.cedula ");
        if(mysql_num_rows($verificar_cedula) != 0)
        {   
            $fecha = date("Y-m-d");
            $verificar_asistencia = mysql_query("SELECT * FROM asistencia, users, persona WHERE asistencia.cedula = '$cedula' AND asistencia.fecha = '$fecha' AND users.cedula = asistencia.cedula AND persona.cedula = asistencia.cedula ");
            $persona = mysql_fetch_assoc($verificar_asistencia);
            $rol = $persona['rol'];

            if($persona['verificacion_entrada'] == "Asistencia")
            {
                $urlEntrada = "javascript:alert('Ya ha registrado la asistencia de entrada.')";
                $classEntrada = "fa-check";
                $mensajeEntrada = "Asistencia de entrada registrada";
            }
            
            if($persona['verificacion_salida'] == "Asistencia")
            {
                $urlSalida = "javascript:alert('Ya ha registrado la asistencia de salida.')";
                $classSalida = "fa-check";
                $mensajeSalida = "Asistencia de salida registrada";
            }
            
            if($persona['verificacion_entrada'] == "Inasistente")
            {
                $urlEntrada = "../procesos/asistencia.php?cedula=".$cedula."&asistencia=Entrada&category=".$rol;
                $classEntrada = "fa-sign-in";
                $mensajeEntrada = "Registrar asistencia de entrada";
            }
            
            if($persona['verificacion_salida'] == "Inasistente")
            {
                $urlSalida = "../procesos/asistencia.php?cedula=".$cedula."&asistencia=Salida&category=".$rol;
                $classSalida = "fa-sign-out";
                $mensajeSalida = "Registrar asistencia de salida";
            }
        }
        else
        {
            $_SESSION['menssage'] = "La cedula $cedula no se encuentra registrada en el sistema.";
            header("Location:asistencia.php?categoria=$categoria");
            die();
        }
    }

    $titulo = "<h1>Asistencia $categoria /</h1><p>Formulario para verificar y registrar la asistencia</p>";

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de asistencia</title>

        <!-- CSS -->
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/animate.css">
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <link rel="stylesheet" href="../assets/flexslider/flexslider.css">
        <link rel="stylesheet" href="../assets/css/form-elements.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/media-queries.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

        <style>

select{
  font-size:13px;
  font-family:sans-serif;
  text-shadow: 0px 1px 0 rgba(255,255,255,0.4);
  color: #000000;
  border-radius: 3px;
  padding: 9px;
  display: inline-block;
  font-family: 'Lato', sans-serif;
  font-style: italic;
  background:#ECECEC;
}
label{
    color:black;
}
        </style>

    </head>

    <body>

        <!-- Top menu -->
        <nav class="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="">Sistema de asistencia</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="top-navbar-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li  class="dropdown">
                            <a href="../"><i class="fa fa-home"></i><br>Inicio</a>
                        </li>
                        <?php if(isset($_SESSION['user'])){ ?>
                        <li class="dropdown <?=$classDocente?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown" data-delay="100">
                                <i class="fa fa-book"></i><br>Docente<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_docente.php">Registro</a></li>
                                <li><a href="asistencia.php?categoria=Docente">Asistencia</a></li>
                            </ul>
                        </li>
                        <li class="dropdown <?=$classAdministrativo?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-institution"></i><br>Administrativo<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_administrativo.php">Registro</a></li>
                                <li><a href="asistencia.php?categoria=Administrativo">Asistencia</a></li>
                            </ul>
                        </li>
                        <li  class="dropdown <?=$classObrero?>">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-briefcase"></i><br>Obrero<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_obrero.php">Registro</a></li>
                                <li><a href="asistencia.php?categoria=Obrero">Asistencia</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-print"></i><br>Reportes</a>
                        </li>
                        <li>
                            <a href="registro_administrador.php"><i class="fa fa-user"></i><br>Administrador</a>
                        </li>
                        <li>
                            <a href="../procesos/salir.php"><i class="fa fa-sign-out"></i><br>Salir</a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
<?php if(! isset($cedula)){ ?>
        <!-- Page Title -->
        <div class="page-title-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeIn">
                        <i class="fa fa-user"></i>
                        <?=$titulo?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="contact-us-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 contact-form wow fadeInLeft">
                        <form role="form" name="registro_docente" action="" method="post">
                            <input type="hidden" name="categoria" value="<?=$categoria?>">
                            <div class="form-group">
                                <label for="contact-name">Cedula</label>
                                <input type="text" name="cedula" placeholder="Cedula" class="contact-name" id="contact-name">
                            </div>
                            
                            <button type="submit" name="aceptar" class="btn">Aceptar</button>
                        
                        </form>
                    </div>
                    <div class="col-sm-5 contact-form wow fadeInRight">
                    </div>
                </div>
                        <br><br><br><br><br><br><br><br>
            </div>
        </div>
<?php }else{ ?>
<!-- Presentation -->
        <div class="presentation-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeInLeftBig">
                        <h1>Control de asistencia de <?=$persona['nombre']." ".$persona['apellido']?></h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div class="services-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-3">
                        <div class="service wow fadeInDown">
                            <div class="service-icon"><i class="fa <?=$classEntrada?>"></i></div>
                            <h3>Entrada</h3>
                            <p><?=$mensajeEntrada?></p>
                            <a class="big-link-1" href="<?=$urlEntrada?>">Aceptar</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="service wow fadeInUp">
                            <div class="service-icon"><i class="fa <?=$classSalida?>"></i></div>
                            <h3>Salida</h3>
                            <p><?=$mensajeSalida?></p>
                            <a class="big-link-1" href="<?=$urlSalida?>">Aceptar</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
            </div>
        </div>
<br><br><br><br><br><br><br><br><br>
<?php } ?>
        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-7 footer-copyright wow fadeIn">
                        <p>Derechos reservados 2015</p>
                    </div>
                    <div class="col-sm-5 footer-social wow fadeIn">
                        <p>Version 1.0</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <script src="../assets/js/jquery-1.11.1.min.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap-hover-dropdown.min.js"></script>
        <script src="../assets/js/jquery.backstretch.min.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/retina-1.1.0.min.js"></script>
        <script src="../assets/js/jquery.magnific-popup.min.js"></script>
        <script src="../assets/flexslider/jquery.flexslider-min.js"></script>
        <script src="../assets/js/jflickrfeed.min.js"></script>
        <script src="../assets/js/masonry.pkgd.min.js"></script>
        <script src="../assets/js/jquery.ui.map.min.js"></script>
        <script src="../assets/js/jquery.ui.map.min.js"></script>
        <script src="../js/fecha.js"></script>

<?php 

if(isset($_SESSION['menssage']) && $_SESSION['menssage'] != "")
{

  printf("<script type='text/javascript' language='javascript'>

  alert('".$_SESSION['menssage']."');

    </script>");

  unset($_SESSION['menssage']);
}

 ?>

    </body>

</html>