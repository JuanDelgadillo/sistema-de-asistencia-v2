<?php

session_start();

include_once "../config/conection.php";

extract($_REQUEST);

if(isset($aceptar))
{
    
    if($tipo_reporte == "Docentes")
    {
        $data_docentes = mysql_query("SELECT * FROM persona, asistencia, users WHERE persona.cedula = asistencia.cedula AND persona.cedula = users.cedula AND users.rol = 2 AND asistencia.fecha BETWEEN '$fdesde' AND '$fhasta' ");
    }
    elseif($tipo_reporte == "Administrativos")
    {
        $data_administrativos = mysql_query("SELECT * FROM persona, asistencia, users WHERE persona.cedula = asistencia.cedula AND persona.cedula = users.cedula AND users.rol = 3 AND asistencia.fecha BETWEEN '$fdesde' AND '$fhasta' ");
    }
    elseif($tipo_reporte == "Obreros")
    {
        $data_obreros = mysql_query("SELECT * FROM persona, asistencia, users WHERE persona.cedula = asistencia.cedula AND persona.cedula = users.cedula AND users.rol = 4 AND asistencia.fecha BETWEEN '$fdesde' AND '$fhasta' ");
    }
    elseif($tipo_reporte == "Todos")
    {
        //var_dump($_REQUEST);
        $data_docentes = mysql_query("SELECT * FROM persona, asistencia, users WHERE persona.cedula = asistencia.cedula AND persona.cedula = users.cedula AND users.rol = '2' AND asistencia.fecha BETWEEN '$fdesde' AND '$fhasta' ");
        $data_administrativos = mysql_query("SELECT * FROM persona, asistencia, users WHERE persona.cedula = asistencia.cedula AND persona.cedula = users.cedula AND users.rol = 3 AND asistencia.fecha BETWEEN '$fdesde' AND '$fhasta' ");
        $data_obreros = mysql_query("SELECT * FROM persona, asistencia, users WHERE persona.cedula = asistencia.cedula AND persona.cedula = users.cedula AND users.rol = 4 AND asistencia.fecha BETWEEN '$fdesde' AND '$fhasta' ");
        
    }
    elseif($tipo_reporte == "Por cedula")
    {
        $verificar_cedula = mysql_query("SELECT * FROM persona, users WHERE persona.cedula = '$cedula' AND users.cedula = persona.cedula ");
        if(mysql_num_rows($verificar_cedula) != 0)
        {
            $data_persona = mysql_query("SELECT * FROM persona, asistencia, users WHERE persona.cedula = '$cedula' AND users.cedula = '$cedula' AND asistencia.cedula = '$cedula' AND asistencia.fecha BETWEEN '$fdesde' AND '$fhasta' ");
        }
        else
        {
            $_SESSION['menssage'] = "La cedula $cedula no se encuentra registrada en el sistema.";
            header("Location:../");
            die();
        }
    }

}
else
{
    header("Location:../");
    die();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
 
    <meta charset="utf-8">
    <title>Reporte de asistencia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content=" ">

    <!-- The styles -->
    <link id="bs-css" href="../css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href='../css/estilos.css' rel='stylesheet'>
    <!-- jQuery -->
 

    
    
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

 <script>

 window.addEventListener("load",function(){
    //window.print();
 },false);

 </script>

</head>


<body>  
        
<?php

    if($tipo_reporte == "Docentes")
    {
        ?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

 
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
          
    

<div class="contant" ><div class="thumbnail">
 
 
<section id="cc">
   
 
 
 
 <table>
    
    <tr><center><h3>Reporte de asistencia</h3></center>

</tr>
    
 </table>
 

 
<table class="table table-bordered" >

<b><center>DOCENTES</center></b><br>

    
 <tr class="danger">
    <th width="15%">Cedula</th>
    <th width="15%">Nombre</th>
    <th width="15%">Apellido</th>
    <th width="15%">Fecha</th>
    <th width="15%">Entrada</th>
    <th width="15%">Salida</th>
    
    </tr>
    
 
<?php while($row = mysql_fetch_assoc($data_docentes)){ 
    if($row['fecha_hora_entrada'] == "0000-00-00 00:00:00") $row['fecha_hora_entrada'] = "Inasistente";
    if($row['fecha_hora_salida'] == "0000-00-00 00:00:00") $row['fecha_hora_salida'] = "Inasistente";
    ?>
<tr>
        
<td><?=$row['cedula']?></td>
<td><?=$row['nombre']?></td>
<td><?=$row['apellido']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['fecha_hora_entrada']?></td>
<td><?=$row['fecha_hora_salida']?></td>
</tr>
<?php } ?>
    
 </td></tr>

 
 
</table>

    
    
</td></tr>


</table>
  
  
 </td>
 
</tr> 


</table>

</section>
        </div>
    </div>
</div>


</div>
        <?php
    }
    elseif($tipo_reporte == "Administrativos")
    {
        ?>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

 
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
          
    

<div class="contant" ><div class="thumbnail">
 
 
<section id="cc">
   
 
 
 
 <table>
    
    <tr><center><h3>Reporte de asistencia</h3></center>

</tr>
    
 </table>
 

 
<table class="table table-bordered" >

<b><center>ADMINISTRATIVOS</center></b><br>

    
 <tr class="danger">
    <th width="15%">Cedula</th>
    <th width="15%">Nombre</th>
    <th width="15%">Apellido</th>
    <th width="15%">Fecha</th>
    <th width="15%">Entrada</th>
    <th width="15%">Salida</th>
    
    </tr>
    
 
<?php while($row = mysql_fetch_assoc($data_administrativos)){ 
    if($row['fecha_hora_entrada'] == "0000-00-00 00:00:00") $row['fecha_hora_entrada'] = "Inasistente";
    if($row['fecha_hora_salida'] == "0000-00-00 00:00:00") $row['fecha_hora_salida'] = "Inasistente";
    ?>
<tr>
        
<td><?=$row['cedula']?></td>
<td><?=$row['nombre']?></td>
<td><?=$row['apellido']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['fecha_hora_entrada']?></td>
<td><?=$row['fecha_hora_salida']?></td>
</tr>
<?php } ?>
    
 </td></tr>

 
 
</table>

    
    
</td></tr>


</table>
  
  
 </td>
 
</tr> 


</table>

</section>
        </div>
    </div>
</div>


</div>

        <?php
    }
    elseif($tipo_reporte == "Obreros")
    {
        ?>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

 
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
          
    

<div class="contant" ><div class="thumbnail">
 
 
<section id="cc">
   
 
 
 
 <table>
    
    <tr><center><h3>Reporte de asistencia</h3></center>

</tr>
    
 </table>
 

 
<table class="table table-bordered" >

<b><center>OBREROS</center></b><br>

    
 <tr class="danger">
    <th width="15%">Cedula</th>
    <th width="15%">Nombre</th>
    <th width="15%">Apellido</th>
    <th width="15%">Fecha</th>
    <th width="15%">Entrada</th>
    <th width="15%">Salida</th>
    
    </tr>
    
 
<?php while($row = mysql_fetch_assoc($data_obreros)){ 
    if($row['fecha_hora_entrada'] == "0000-00-00 00:00:00") $row['fecha_hora_entrada'] = "Inasistente";
    if($row['fecha_hora_salida'] == "0000-00-00 00:00:00") $row['fecha_hora_salida'] = "Inasistente";
    ?>
<tr>
        
<td><?=$row['cedula']?></td>
<td><?=$row['nombre']?></td>
<td><?=$row['apellido']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['fecha_hora_entrada']?></td>
<td><?=$row['fecha_hora_salida']?></td>
</tr>
<?php } ?>
    
 </td></tr>

 
 
</table>

    
    
</td></tr>


</table>
  
  
 </td>
 
</tr> 


</table>

</section>
        </div>
    </div>
</div>


</div>
    

        <?php
    }
    elseif($tipo_reporte == "Todos")
    {
        
        ?>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

 
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
          
    

<div class="contant" ><div class="thumbnail">
 
 
<section id="cc">
   
 
 
 
 <table>
    
    <tr><center><h3>Reporte de asistencia</h3></center>

</tr>
    
 </table>
 

<table width="100%" class="table table-bordered" >
    <b><center>DOCENTES</center></b><br>
 
    
  <tr class="danger">
    <th width="15%">Cedula</th>
    <th width="15%">Nombre</th>
    <th width="15%">Apellido</th>
    <th width="15%">Fecha</th>
    <th width="15%">Entrada</th>
    <th width="15%">Salida</th>
    
    </tr>
    
<?php while($row = mysql_fetch_assoc($data_docentes)){ 

    if($row['fecha_hora_entrada'] == "0000-00-00 00:00:00") $row['fecha_hora_entrada'] = "Inasistente";
    if($row['fecha_hora_salida'] == "0000-00-00 00:00:00") $row['fecha_hora_salida'] = "Inasistente";

    ?>
<tr>
        
<td><?=$row['cedula']?></td>
<td><?=$row['nombre']?></td>
<td><?=$row['apellido']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['fecha_hora_entrada']?></td>
<td><?=$row['fecha_hora_salida']?></td>
</tr>
<?php } ?>



</table>

<table class="table table-bordered" >

<b><center>ADMINISTRATIVOS</center></b><br>
 
    
  <tr class="danger">
    <th width="15%">Cedula</th>
    <th width="15%">Nombre</th>
    <th width="15%">Apellido</th>
    <th width="15%">Fecha</th>
    <th width="15%">Entrada</th>
    <th width="15%">Salida</th>
    
    </tr>
    
 
<?php while($row = mysql_fetch_assoc($data_administrativos)){ 
    if($row['fecha_hora_entrada'] == "0000-00-00 00:00:00") $row['fecha_hora_entrada'] = "Inasistente";
    if($row['fecha_hora_salida'] == "0000-00-00 00:00:00") $row['fecha_hora_salida'] = "Inasistente";

    ?>
<tr>
        
<td><?=$row['cedula']?></td>
<td><?=$row['nombre']?></td>
<td><?=$row['apellido']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['fecha_hora_entrada']?></td>
<td><?=$row['fecha_hora_salida']?></td>
</tr>
<?php } ?>
    
    
    
 </td></tr>

 
 
</table>

 
<table class="table table-bordered" >

<b><center>OBREROS</center></b><br>

    
 <tr class="danger">
    <th width="15%">Cedula</th>
    <th width="15%">Nombre</th>
    <th width="15%">Apellido</th>
    <th width="15%">Fecha</th>
    <th width="15%">Entrada</th>
    <th width="15%">Salida</th>
    
    </tr>
    
 
<?php while($row = mysql_fetch_assoc($data_obreros)){ 
    if($row['fecha_hora_entrada'] == "0000-00-00 00:00:00") $row['fecha_hora_entrada'] = "Inasistente";
    if($row['fecha_hora_salida'] == "0000-00-00 00:00:00") $row['fecha_hora_salida'] = "Inasistente";

    ?>
<tr>
        
<td><?=$row['cedula']?></td>
<td><?=$row['nombre']?></td>
<td><?=$row['apellido']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['fecha_hora_entrada']?></td>
<td><?=$row['fecha_hora_salida']?></td>
</tr>
<?php } ?>
    
 </td></tr>

 
 
</table>

    
    
</td></tr>


</table>
  
  
 </td>
 
</tr> 


</table>

</section>
        </div>
    </div>
</div>


</div>


        <?php
    }
    elseif($tipo_reporte == "Por cedula")
    {
        ?>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

 
<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
          
    

<div class="contant" ><div class="thumbnail">
 
 
<section id="cc">
   
 
 
 
 <table>
    
    <tr><center><h3>Reporte de asistencia</h3></center>

</tr>
    
 </table>
 

 
<table class="table table-bordered" >

<b><center>PERSONA</center></b><br>

    
 <tr class="danger">
    <th width="15%">Cedula</th>
    <th width="15%">Nombre</th>
    <th width="15%">Apellido</th>
    <th width="15%">Fecha</th>
    <th width="15%">Entrada</th>
    <th width="15%">Salida</th>
    
    </tr>
    
 
<?php while($row = mysql_fetch_assoc($data_persona)){ 
    if($row['fecha_hora_entrada'] == "0000-00-00 00:00:00") $row['fecha_hora_entrada'] = "Inasistente";
    if($row['fecha_hora_salida'] == "0000-00-00 00:00:00") $row['fecha_hora_salida'] = "Inasistente";
    ?>
<tr>
        
<td><?=$row['cedula']?></td>
<td><?=$row['nombre']?></td>
<td><?=$row['apellido']?></td>
<td><?=$row['fecha']?></td>
<td><?=$row['fecha_hora_entrada']?></td>
<td><?=$row['fecha_hora_salida']?></td>
</tr>
<?php } ?>
    
 </td></tr>

 
 
</table>

    
    
</td></tr>


</table>
  
  
 </td>
 
</tr> 


</table>

</section>
        </div>
    </div>
</div>


</div>
        <?
    }


?>
        <!--/.fluid-container-->

<!-- external javascript -->
 

</body>
</html>
