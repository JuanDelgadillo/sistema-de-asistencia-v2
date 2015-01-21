<?php  

include_once "config/conection.php";

session_start();

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
					<a class="navbar-brand" href="index.html">Sistema de asistencia</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li  class="dropdown active">
							<a href=""><i class="fa fa-home"></i><br>Inicio</a>
						</li>
                        <?php if(isset($_SESSION['usuario'])){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"  data-hover="dropdown" data-delay="100">
                                <i class="fa fa-book"></i><br>Docente<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="#">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100"><i class="fa fa-institution"></i><br>Administrativo<span class="caret"></span></a>
                            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                                <li><a href="#">Registro</a></li>
                                <li><a href="#">Asistencia</a></li>
                            </ul>
						</li>
						<li  class="dropdown">
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
                            <a href="procesos/salir.php"><i class="fa fa-sign-out"></i><br>Salir</a>
                        </li>
                        <?php } ?>
					</ul>
				</div>
			</div>
		</nav>
<?php if(! isset($_SESSION['usuario'])){ ?>
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

<?php } if(isset($_SESSION['usuario'])){ ?>
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
		                    <a class="big-link-1" href="#">Ver</a>
		                </div>
					</div>
					<div class="col-sm-3">
		                <div class="service wow fadeInDown">
		                    <div class="service-icon"><i class="fa fa-users"></i></div>
		                    <h3>Administrativo(s)</h3>
		                    <p>Información acercá del personal Administrativo</p>
		                    <a class="big-link-1" href="#">Ver</a>
		                </div>
	                </div>
	                <div class="col-sm-3">
		                <div class="service wow fadeInUp">
		                    <div class="service-icon"><i class="fa fa-users"></i></div>
		                    <h3>Obrero(s)</h3>
		                    <p>Información acercá del personal Obrero&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		                    <a class="big-link-1" href="#">Ver</a>
		                </div>
	                </div>
	                <div class="col-sm-3">
		                <div class="service wow fadeInDown">
		                    <div class="service-icon"><i class="fa fa-user"></i></div>
		                    <h3>Administradores</h3>
		                    <p>Información acercá de las cuentas Administrativas del sistema</p>
		                    <a class="big-link-1" href="#">Ver</a>
		                </div>
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
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
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