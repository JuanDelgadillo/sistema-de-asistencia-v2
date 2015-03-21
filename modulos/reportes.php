<?php  

include_once "../config/conection.php";

session_start();
extract($_REQUEST);
if(! isset($_SESSION['user']))
{
  header("Location:../");
}


    $titulo = "<h1>Reportes /</h1><p>Reportes de asistencia</p>";

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

.contact-form input[type="date"] { width: 35%; }
        </style>

<script>

    window.addEventListener("load",function(){
        tipo_reporte.addEventListener('change',function(){
            if(tipo_reporte.value == "Por cedula")
            {
                cedula.disabled = false;
            }
            else
            {
                cedula.disabled = true;
            }
        },false);
    },false);

</script>

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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown" data-delay="100">
                                <i class="fa fa-book"></i><br>Docente<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_docente.php">Registro</a></li>
                                <li><a href="asistencia.php?categoria=Docente">Asistencia</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-institution"></i><br>Administrativo<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_administrativo.php">Registro</a></li>
                                <li><a href="asistencia.php?categoria=Administrativo">Asistencia</a></li>
                            </ul>
                        </li>
                        <li  class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-briefcase"></i><br>Obrero<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_obrero.php">Registro</a></li>
                                <li><a href="asistencia.php?categoria=Obrero">Asistencia</a></li>
                            </ul>
                        </li>
                        <li class="active">
                            <a href=""><i class="fa fa-print"></i><br>Reportes</a>
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
        
        <!-- Page Title -->
        <div class="page-title-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeIn">
                        <i class="fa fa-print"></i>
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
                        <form role="form" name="registro_docente" action="../procesos/reporte.php" method="post">
                            <div class="form-group">
                                <label for="contact-name">Desde</label><br>
                                <input type="date" name="fdesde" class="contact-name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="contact-email">Tipo de reporte</label><br>
                                <select style="width:25%;" class="sexo" id="tipo_reporte" name="tipo_reporte" required>
                                    <option value="">- Seleccione -</option>
                                    <option value="Docentes">Docentes</option>
                                    <option value="Administrativos">Administrativos</option>
                                    <option value="Obreros">Obreros</option>
                                    <option value="Todos">Todos</option>
                                    <option value="Por cedula">Por cedula</option>
                                  </select>
                            </div><br>
                            <button type="submit" name="aceptar" class="btn">Aceptar</button>
                        
                    </div>
                    <div class="col-sm-5 contact-form wow fadeInRight">
                        <br>
                        <div class="form-group">
                                <label for="contact-name">Hasta</label><br>
                                <input type="date" name="fhasta" class="contact-name" required>
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Cédula</label>
                                <input type="text" name="cedula" disabled="true" placeholder="Cédula" class="contact-subject" id="cedula">
                            </div>
                        </form>
                    </div>
                </div>
            </div><br><br><br>
        </div>

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