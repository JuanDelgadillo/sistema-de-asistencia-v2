<?php  

include_once "../config/conection.php";

session_start();
extract($_REQUEST);
if(! isset($_SESSION['user']))
{
  header("Location:../");
}

if(isset($cedula))
{
    $docente = mysql_fetch_assoc(mysql_query("SELECT * FROM persona, docente WHERE persona.cedula = '$cedula' AND docente.cedula = persona.cedula "));
    $titulo = "<h1>Actualizar Docente /</h1><p>Formulario para actualizar un docente</p>";
    $action_form = "../procesos/update.php";
    $cedula = $docente['cedula'];
    $nombre = $docente['nombre'];
    $apellido = $docente['apellido'];
    $sexo = $docente['sexo'];
    $docente['fecha_nac'] = explode("-",$docente['fecha_nac']);
    list($ano,$mes,$dia)=$docente['fecha_nac'];
    $grado_instruccion = $docente['grado_instruccion'];
    $turno = $docente['turno'];
    $especialidad = $docente['especialidad'];
    $asignatura = $docente['asignatura'];
}
else
{
    $titulo = "<h1>Registro Docente /</h1><p>Formulario para registrar un docente</p>";
    $action_form = "../procesos/registro_personal.php";
    $cedula = "";
    $nombre = "";
    $apellido = "";
    $ano = "";
    $mes = "";
    $dia = "";
    $sexo = "";
    $fecha_nac = "";
    $grado_instruccion = "";
    $turno = "";
    $especialidad = "";
    $asignatura = "";
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
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown" data-delay="100">
                                <i class="fa fa-book"></i><br>Docente<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="">Registro</a></li>
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
                        <li  class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-briefcase"></i><br>Obrero<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="registro_obrero.php">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
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
                        <form role="form" name="registro_docente" action="<?=$action_form?>" method="post">
                            <input type="hidden" name="categoria" value="Docente">
                            <input type="hidden" name="cedula_get" value="<?=$cedula?>">
                            <div class="form-group">
                                <label for="contact-name">Cedula</label>
                                <input type="text" value="<?=$cedula?>" name="cedula" placeholder="Cedula" class="contact-name" id="contact-name">
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Apellido</label>
                                <input type="text" name="apellido" value="<?=$apellido?>" placeholder="Apellido" class="contact-email" id="contact-email">
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Fecha de nacimiento</label><br>
                                <select style="width:17%;" name="dia_nac" required>
                                    <option value="">D&iacute;a</option>
                                    <?php if($cedula != ""){ ?>
                                    <option selected value="<?=$dia?>"><?=$dia?></option>
                                    <?php } ?>
                                </select>
                                <select style="width:25%;" name="mes_nac" onchange="d_m_fnac();" required>
                                    <option value="0">Mes</option>
                                    <option <?php if($mes == 1) echo "SELECTED" ?> value="1">Enero</option>
                                    <option <?php if($mes == 2) echo "SELECTED" ?> value="2">Febrero</option>
                                    <option <?php if($mes == 3) echo "SELECTED" ?> value="3">Marzo</option>
                                    <option <?php if($mes == 4) echo "SELECTED" ?> value="4">Abril</option>
                                    <option <?php if($mes == 5) echo "SELECTED" ?> value="5">Mayo</option>
                                    <option <?php if($mes == 6) echo "SELECTED" ?> value="6">Junio</option>
                                    <option <?php if($mes == 7) echo "SELECTED" ?> value="7">Julio</option>
                                    <option <?php if($mes == 8) echo "SELECTED" ?> value="8">Agosto</option>
                                    <option <?php if($mes == 9) echo "SELECTED" ?> value="9">Septiembre</option>
                                    <option <?php if($mes == 10) echo "SELECTED" ?> value="10">Octubre</option>
                                    <option <?php if($mes == 11) echo "SELECTED" ?> value="11">Noviembre</option>
                                    <option <?php if($mes == 12) echo "SELECTED" ?> value="12">Diciembre</option></select>
                                <select style="width:18%;margin-right: 2em;" name="ano_nac" onchange="d_m_fnac();" required>
                                    <option value="">Año</option>
                                    <?php for($x = 2015; $x > 1940; $x--){ ?>
                                    <option <?php if($ano == $x) echo "SELECTED" ?> value="<?=$x?>" ><?=$x?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Grado de instrucción</label>
                                <input type="text" name="grado_instruccion" value="<?=$grado_instruccion?>" placeholder="Grado de instrucción" class="contact-subject" id="contact-subject">
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Especialidad</label>
                                <input type="text" name="especialidad" value="<?=$especialidad?>" placeholder="Especialidad" class="contact-subject" id="contact-subject">
                            </div>
                            <button type="submit" name="aceptar" class="btn">Aceptar</button>
                        
                    </div>
                    <div class="col-sm-5 contact-form wow fadeInRight">
                        <br>
                        <div class="form-group">
                                <label for="contact-name">Nombre</label>
                                <input type="text" name="nombre" placeholder="Nombre" value="<?=$nombre?>" class="contact-name" id="contact-name">
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Sexo</label><br>
                                <select class="sexo" name="sexo" required>
                                    <option value="">- Sexo -</option>
                                    <option <?php if($sexo == "Hombre") echo "SELECTED" ?> value="Hombre">Hombre</option>
                                    <option <?php if($sexo == "Mujer") echo "SELECTED" ?> value="Mujer">Mujer</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Turno</label><br> 
                                <select style="width:25%;" class="sexo" name="turno" required>
                                    <option value="">- Turno -</option>
                                    <option <?php if($turno == "Mañana") echo "SELECTED" ?> value="Mañana">Mañana</option>
                                    <option <?php if($turno == "Tarde") echo "SELECTED" ?> value="Tarde">Tarde</option>
                                  </select>
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Asignatura</label>
                                <input type="text" name="asignatura" value="<?=$asignatura?>" placeholder="Asignatura" class="contact-subject" id="contact-subject">
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