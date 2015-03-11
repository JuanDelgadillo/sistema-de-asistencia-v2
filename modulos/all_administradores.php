<?php  

include_once "../config/conection.php";

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
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/animate.css">
        <link rel="stylesheet" href="../assets/css/magnific-popup.css">
        <link rel="stylesheet" href="../assets/flexslider/flexslider.css">
        <link rel="stylesheet" href="../assets/css/form-elements.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/media-queries.css">
        <link rel="stylesheet" href="../assets/css/style_login.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

        <style type="text/css">

table { 
  margin: 10px 0 30px 0;
}

table tr th, table tr td { 
  background: #9d426b;
  color: #FFF;
  padding: 7px 4px;
  text-align: left;
  border:1px solid white;
}

table tr td { 
  background: #D3F2F7;
  color: #47433F;
  border-top: 1px solid #FFF;
  padding: 7px;
}

    #auditoria {
        width:100%;
        height:400px;
        overflow: scroll;
        overflow-y:auto;
        background-color: #EEE;
        margin:0 auto;
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
                <?php if(! isset($_SESSION['user'])){ ?>
                    <span id="titulo" style="font-weight:bold;color:black;font-size:25px;"><br>Escuela Básica Estudiantil Dr. Orangel Rodríguez</span>
                <?php } ?>
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
<?php if(isset($_SESSION['user'])){ ?>
        <!-- Presentation -->
        <div class="presentation-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 wow fadeInLeftBig">
                        <h1>Usuarios registrados</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services -->
        <div class="services-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section group">
              <div>
                      <div id="auditoria">
        <table style="width:1900px; margin-top:0;" >
          <tr>
            <th style="text-align:center;">Cedula</th>
            <th style="text-align:center;">Nombre</th>
            <th style="text-align:center;">Apellido</th>
            <th style="text-align:center;">Sexo</th>
            <th style="text-align:center;">Fecha de Nacimiento</th>
            <th style="text-align:center;">Grado de instrucción</th>
            <th style="text-align:center;">Nombre de usuario</th>
            <th style="text-align:center;">Contraseña</th>
            <th style="text-align:center;">Rol</th>
            <th style="text-align:center;">Operaciones</th>
          </tr>
          <?php

          $administradores = mysql_query("SELECT * FROM persona, users WHERE persona.cedula = users.cedula ");

          while ($row = mysql_fetch_assoc($administradores))
          {
            if($row['rol'] == 1) $rol = "Administrador";
             elseif ($row['rol'] == 2) $rol = "Docente";
             elseif ($row['rol'] == 3) $rol = "Administrativo(a)";
             elseif ($row['rol'] == 4) $rol = "Obrero(a)";
          ?>
          <tr>
            <td style="text-align:center;"><?=$row['cedula']?></td>
            <td style="text-align:center;"><?=$row['nombre']?></td>
            <td style="text-align:center;"><?=$row['apellido']?></td>
            <td style="text-align:center;"><?=$row['sexo']?></td>
            <td style="text-align:center;"><?=$row['fecha_nac']?></td>
            <td style="text-align:center;"><?=$row['grado_instruccion']?></td>
            <td style="text-align:center;"><?=$row['user']?></td>
            <td style="text-align:center;"><?=$row['password']?></td>
            <td style="text-align:center;"><?=$rol?></td>
            <td style="text-align:center;">
                <?php if($row['cedula'] != 00000000){ ?>
                <a href="registro_administrador.php?cedula=<?=$row['cedula']?>">Actualizar</a> - <a href="../procesos/delete.php?cedula=<?=$row['cedula']?>&categoria=Usuario">Eliminar</a>
                <?php } ?>
            </td>
          </tr>
         <?php } ?>
        </table>
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
        <script src="../http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="../assets/js/jquery.ui.map.min.js"></script>
        <script src="../assets/js/scripts.js"></script>

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