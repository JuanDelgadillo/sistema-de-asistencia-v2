<?php  

include_once "config/conection.php";

session_start();

if(isset($_SESSION['user']) && $_SESSION['rol'] != 1)
{
    $cedula = $_SESSION['cedula_user'];
    $rol = $_SESSION['rol'];
    $fecha = date("Y-m-d");
    $verificar_asistencia = mysql_query("SELECT * FROM asistencia WHERE cedula = '$cedula' AND fecha = '$fecha' ");
    $persona = mysql_fetch_assoc($verificar_asistencia);

    if($persona['verificacion_entrada'] == "Asistencia")
    {
        $urlEntrada = "javascript:alert('Ya has registrado la asistencia de entrada.')";
        $classEntrada = "fa-check";
        $mensajeEntrada = "Asistencia de entrada registrada";
    }
    
    if($persona['verificacion_salida'] == "Asistencia")
    {
        $urlSalida = "javascript:alert('Ya has registrado la asistencia de salida.')";
        $classSalida = "fa-check";
        $mensajeSalida = "Asistencia de salida registrada";
    }
    
    if($persona['verificacion_entrada'] == "Inasistente")
    {
        $urlEntrada = "procesos/asistencia.php?cedula=".$cedula."&asistencia=Entrada&category=".$rol;
        $classEntrada = "fa-sign-in";
        $mensajeEntrada = "Registrar asistencia de entrada";
    }
    
    if($persona['verificacion_salida'] == "Inasistente")
    {
        $urlSalida = "procesos/asistencia.php?cedula=".$cedula."&asistencia=Salida&category=".$rol;
        $classSalida = "fa-sign-out";
        $mensajeSalida = "Registrar asistencia de salida";
    }
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
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/flexslider/flexslider.css">
        <link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/media-queries.css">
        <link rel="stylesheet" href="assets/css/style_login.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

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
                <?php if(! isset($_SESSION['user']) || isset($_SESSION['user']) && $_SESSION['rol'] != 1){ ?>
                    <span id="titulo" style="font-weight:bold;color:black;font-size:25px;"><br>Escuela Básica Estudiantil Dr. Orangel Rodríguez</span>
				<?php } ?>
                    <ul class="nav navbar-nav navbar-right">
						<li  class="dropdown active">
							<a href=""><i class="fa fa-home"></i><br>Inicio</a>
						</li>
                        <?php if(isset($_SESSION['user']) && $_SESSION['rol'] == 1){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown" data-delay="100">
                                <i class="fa fa-book"></i><br>Docente<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="modulos/registro_docente.php">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-institution"></i><br>Administrativo<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="modulos/registro_administrativo.php">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
						</li>
						<li  class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-briefcase"></i><br>Obrero<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="modulos/registro_obrero.php">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
						</li>
						<li>
							<a href="#"><i class="fa fa-print"></i><br>Reportes</a>
						</li>
						<li>
							<a href="modulos/registro_administrador.php"><i class="fa fa-user"></i><br>Administrador</a>
						</li>
                        <?php } ?>
                         <?php if(isset($_SESSION['user'])){ ?>
                        <li>
                            <a href="procesos/salir.php"><i class="fa fa-sign-out"></i><br>Salir</a>
                        </li>
                         <?php } ?>
					</ul>
				</div>
			</div>
		</nav>
<?php if(! isset($_SESSION['user'])){ ?>
<div class="login-form">
    <br><br>
            <h1>Control de acceso</h1>
                    <div class="head">
                        <img src="assets/img/user.png" alt=""/>
                    </div>
                    <form method="POST" action="procesos/login.php">
                        <input type="text" name="user" requiredvalue="Usuario" placeholder="Usuario">
                        <input type="password" name="contrasena" required placeholder="Contraseña">
                        <div class="submit">
                            <input type="submit" name="ingresar" value="Iniciar sesión" >
                    </div>
                </form>
            </div>

<?php } if(isset($_SESSION['user']) && $_SESSION['rol'] == 1){ ?>
        <!-- Presentation -->
        <div class="presentation-container">
        	<div class="container">
        		<div class="row">
	        		<div class="col-sm-12 wow fadeInLeftBig">
	            		<h1>Información del sistema</h1>
	            	</div>
            	</div>
        	</div>
        </div>

        <!-- Services -->
        <div class="services-container">
	        <div class="container">
	            <div class="row">
	            	<div class="col-sm-3">
		                <div class="service wow fadeInUp">
		                    <div class="service-icon"><i class="fa fa-users"></i></div>
		                    <h3>Docente(s)</h3>
		                    <p>Información acercá del personal Docente &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		                    <a class="big-link-1" href="modulos/all_docentes.php">Ver</a>
		                </div>
					</div>
					<div class="col-sm-3">
		                <div class="service wow fadeInDown">
		                    <div class="service-icon"><i class="fa fa-users"></i></div>
		                    <h3>Administrativo(s)</h3>
		                    <p>Información acercá del personal Administrativo</p>
		                    <a class="big-link-1" href="modulos/all_administrativos.php">Ver</a>
		                </div>
	                </div>
	                <div class="col-sm-3">
		                <div class="service wow fadeInUp">
		                    <div class="service-icon"><i class="fa fa-users"></i></div>
		                    <h3>Obrero(s)</h3>
		                    <p>Información acercá del personal Obrero&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		                    <a class="big-link-1" href="modulos/all_obreros.php">Ver</a>
		                </div>
	                </div>
	                <div class="col-sm-3">
		                <div class="service wow fadeInDown">
		                    <div class="service-icon"><i class="fa fa-user"></i></div>
		                    <h3>Usuarios</h3>
		                    <p>Información acercá de las cuentas de usuario del sistema</p>
		                    <a class="big-link-1" href="modulos/all_administradores.php">Ver</a>
		                </div>
	                </div>
	            </div>
	        </div>
        </div>
<br><br><br><br><br><br><br><br><br>
<?php } elseif(isset($_SESSION['user']) && $_SESSION['rol'] != 1){ ?>
 <!-- Presentation -->
        <div class="presentation-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeInLeftBig">
                        <h1>Control de asistencia</h1>
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
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/flexslider/jquery.flexslider-min.js"></script>
        <script src="assets/js/jflickrfeed.min.js"></script>
        <script src="assets/js/masonry.pkgd.min.js"></script>
        <script src="assets/js/jquery.ui.map.min.js"></script>
        <script src="assets/js/scripts.js"></script>

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