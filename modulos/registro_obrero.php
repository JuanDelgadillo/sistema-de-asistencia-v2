<?php  

include_once "../config/conection.php";

session_start();

if(! isset($_SESSION['user']))
{
  header("Location:../");
}

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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown" data-delay="100">
                                <i class="fa fa-book"></i><br>Docente<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_docente.php">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-institution"></i><br>Administrativo<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_administrativo.php">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
                        </li>
                        <li  class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-briefcase"></i><br>Obrero<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="#">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-print"></i><br>Reportes</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user"></i><br>Administrador</a>
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
                        <i class="fa fa-user"></i>
                        <h1>Registro Obrero /</h1>
                        <p>Formulario para registrar un obrero</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Us -->
        <div class="contact-us-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 contact-form wow fadeInLeft">
                        <form role="form" name="registro_docente" action="../procesos/registro_personal.php" method="post">
                            <input type="hidden" name="categoria" value="Obrero">
                            <div class="form-group">
                                <label for="contact-name">Cedula</label>
                                <input type="text" name="cedula" placeholder="Cedula" class="contact-name" id="contact-name">
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Apellido</label>
                                <input type="text" name="apellido" placeholder="Apellido" class="contact-email" id="contact-email">
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Fecha de nacimiento</label><br>
                                <select style="width:17%;" name="dia_nac" required>
                                    <option value="">D&iacute;a</option>
                                </select>
                                <select style="width:25%;" name="mes_nac" onchange="d_m_fnac();" required>
                                    <option value="0">Mes</option>
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option></select>
                                <select style="width:18%;margin-right: 2em;" name="ano_nac" onchange="d_m_fnac();" required>
                                    <option value="">Año</option>
                                    <?php for($x = 2015; $x > 1940; $x--){ ?>
                                    <option value="<?=$x?>" ><?=$x?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Grado de instrucción</label>
                                <input type="text" name="grado_instruccion" placeholder="Grado de instrucción" class="contact-subject" id="contact-subject">
                            </div>
                            <div class="form-group">
                            </div>
                            <button type="submit" name="aceptar" class="btn">Aceptar</button>
                        
                    </div>
                    <div class="col-sm-5 contact-form wow fadeInRight">
                        <br>
                        <div class="form-group">
                                <label for="contact-name">Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre" class="contact-name" id="contact-name">
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Sexo</label><br>
                                <select class="sexo" name="sexo" required>
                                    <option value="">- Sexo -</option>
                                    <option value="Hombre">Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Turno</label><br> 
                                <select style="width:25%;" class="sexo" name="turno" required>
                                    <option value="">- Turno -</option>
                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Area</label>
                                <input type="text" name="area" placeholder="Area" class="contact-subject" id="contact-subject">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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