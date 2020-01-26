<?php

 $error = 0;
 $crear = 0;
 $modificar = 0;
 
 $documento_reporte_ventas = '';
 $documento_reporte_inventario = '';
 $id_mes = 0;

 require_once ('conexion_sesion.php');

 if($_POST[subir_reporte])
 {
  $documento_reporte_ventas = basename($_FILES["reporte_ventas"]["name"]);
  $documento_reporte_inventario = basename($_FILES["reporte_inventario"]["name"]);
  $id_mes = isset($_POST['id_mes']) ? trim(mysqli_real_escape_string($conexion,$_POST['id_mes'])) : '0';

  $error_reporte_ventas = '';
  $error_reporte_inventario = '';
  $error_mes = '';
  
  if($documento_reporte_ventas == '')
  {
   $error_reporte_ventas = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Subir Reporte de Ventas.</div>';
   $error = 1;
  }
  if($documento_reporte_inventario == '')
  {
   $error_reporte_inventario = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Subir Reporte de Inventario.</div>';
   $error = 1;
  }
  if($id_mes == 0)
  {
   $error_mes = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Mes.</div>';
   $error = 1;
  }
  
  require_once ('modelo_reportes.php');
  
  if($crear)
  {
   $modulo = 2;
   $accion = 'CREAR';
   $id_afectado = mysqli_insert_id($conexion);
   $descripcion = 'Crear Actividad '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 21;
  }
  else
  {
   $mensaje = 22;
  }
  echo '<script language="JavaScript" type="text/javascript">document.location.href="reportes.php?m='.$mensaje.'"</script>';
 }
 elseif($_POST[rechazo])
 {
  $motivo_rechazo = isset($_POST['motivo_rechazo']) ? trim(mysqli_real_escape_string($conexion,$_POST['motivo_rechazo'])) : '';
  $id_modificar = !empty($_GET['id'])? mysqli_real_escape_string($conexion,$_GET['id']):0;
  
  if($motivo_rechazo == '' || $id_modificar == 0)
  {
   $mensaje = 666;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
  }
  
  require_once ('modelo_reportes.php');
  
  if($modificar)
  {
   $modulo = 2;
   $accion = 'CREAR';
   $id_afectado = mysqli_insert_id($conexion);
   $descripcion = 'Crear Actividad '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
  }
  else
  {
   $mensaje = 32;
  }
  
  echo '<script language="JavaScript" type="text/javascript">document.location.href="reportes.php?m='.$mensaje.'"</script>';
 } 
 else
 {
  $error = 1;
  require_once ('modelo_reportes.php');
 }
 
 $menu_mes = '<select id="id_mes" name="id_mes" class="form-control" required/>';
 $menu_mes .= '<option value = ""> Seleccionar ';
 if($cantidad_mes != 1)
 {
  foreach($meses as $mes)
  { 
   if($id_mes == $mes['id'])
   {
    $menu_mes .= ' <option value = '.$mes['id'].' selected> '.$mes['nombre'].'</option>';
   }
   else
   {
    $menu_mes .= ' <option value = '.$mes['id'].'> '.$mes['nombre'].'</option>';
   }
  }
 }
 $menu_mes .= '</select>';
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($reporte as $reportes)
  {  
   $listar .= ' <tr>';

   $listar .= '  <td width="35px">';

   if($reportes['estado']==0)
   {
    $listar .= '  &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Subido">';
    $listar .= '  <font size="1" color="#FFFFFF">0</font>';
   }
   if($reportes['estado']==1)
   {
    $listar .= '  &nbsp;&nbsp;<img src="img/pausa.png" border="0" alt="En Revision">';
    $listar .= '  <font size="1" color="#FFFFFF">1</font>';
   }
   if($reportes['estado']==2)
   {
    $listar .= '  &nbsp;&nbsp;<img src="img/negro.jpg" border="0" alt="Rechazado">';
    $listar .= '  <font size="1" color="#FFFFFF">2</font>';
   }
   if($reportes['estado']==3)
   {
    $listar .= '  &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Confirmado">';
    $listar .= '  <font size="1" color="#FFFFFF">3</font>';
   }
   
   $listar .= '  </td>';

   if($reportes['estado']==1)
   {
	$listar .= '  <td>';
	$listar .= $reportes['nombre_estado'];
	$listar .= '  </td>';
    
	$listar .= '  <td>';
	if($perfil == 'admin')
    {
	 $listar .= '   <div class="tooltip-reportes">';
	 $listar .= '    <a href="" data-toggle="modal" data-target="#myModal'.$reportes['id'].'">';
	 $listar .= '     <i class="fa fa-ban fa-fw" data-toggle="tooltip" data-placement="top" title="Rechazar"></i>';
     $listar .= '    </a>';
	 $listar .= '  	</div>';
	
   	 $listar .= '   <div class="modal fade" id="myModal'.$reportes['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
	 $listar .= '    <div class="modal-dialog">';
	 $listar .= '  	  <div class="modal-content">';
	 $listar .= '  	   <div class="modal-header">';
	 $listar .= '  	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	 $listar .= '  	    <h4 class="modal-title" id="myModalLabel">Motivo Rechazo</h4>';
	 $listar .= '  	   </div>';
	 $listar .= '      <form class="form-horizontal" role="form" name="formulario" action="reportes.php?id='.$reportes['id'].'" autocomplete="off" method="post" enctype="multipart/form-data">';
	 $listar .= '  	    <div class="modal-body">';
	 $listar .= '  	     <textarea style="width:100%" rows="5" id="motivo_rechazo" name="motivo_rechazo" required autofocus></textarea>';
	 $listar .= '  	    </div>';
	 $listar .= '  	    <div class="modal-footer">';
	 $listar .= '  	     <input type="submit" name="rechazo" id="rechazo" class="btn btn-primary" value="Rechazar">';
	 $listar .= '  	    </div>';
	 $listar .= '  	   </form>';	
	 $listar .= '  	  </div>';
	 $listar .= '    </div>';
	 $listar .= '   </div>';	 
	}
    $listar .= '   </td>';
   }
   elseif($reportes['estado']==2)
   { 
	$listar .= '   <td>';
	$listar .= $reportes['nombre_estado'];
    $listar .= '   </td>';
	$listar .= '   <td>';
	$listar .= '    <div class="tooltip-reportes">';
	$listar .= '     <a href="" data-toggle="modal" data-target="#myModal'.$reportes['id'].'">';
	$listar .= '      <i class="fa fa-info-circle fa-fw" data-toggle="tooltip" data-placement="top" title="Info Rechazo"></i>';
    $listar .= '     </a>';
    $listar .= '    </div>';		
    $listar .= '   </td>';

  	$listar .= '   <div class="modal fade" id="myModal'.$reportes['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
	$listar .= '    <div class="modal-dialog">';
	$listar .= '  	  <div class="modal-content">';
	$listar .= '  	   <div class="modal-header">';
	$listar .= '  	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
	$listar .= '  	    <h4 class="modal-title" id="myModalLabel">Motivo Rechazo</h4>';
	$listar .= '  	   </div>';
	$listar .= '  	   <div align="justify" class="modal-body">';
	$listar .= '  	    '.$reportes['motivo_rechazo'].'';
	$listar .= '  	   </div>';
	$listar .= '  	  </div>';
	$listar .= '    </div>';
	$listar .= '   </div>';
   }
   else
   {
    $listar .= '  <td>'.$reportes['nombre_estado'].'</td>';
    $listar .= '  <td></td>';	
   }
   
   $listar .= '  <td>'.$reportes['mes'].'</td>';
   $listar .= '  <td>'.$reportes['distribuidor'].'</td>';
   $listar .= '  <td>'.$reportes['version'].'</td>';   
   $listar .= '  <td>'.$reportes['fecha'].'</td>';
   $listar .= '  <td>'.$reportes['hora'].'</td>';
   
   $listar .= '  <td align="right" width="50px">';
   $listar .= '   <div class="tooltip-reportes">';
   if($perfil != 'super_schneider' && $perfil != 'admin_schneider')
   {
    $listar .= '    <a href="descargar_reporte.php?id='.$reportes['id'].'&tipo=1" style="text-decoration: none" target="_blank"><i class="fa fa-shopping-cart fa-fw" data-toggle="tooltip" data-placement="top" title="Ventas"></i></a>&nbsp;';
    $listar .= '    <a href="descargar_reporte.php?id='.$reportes['id'].'&tipo=2" style="text-decoration: none" target="_blank"><i class="fa fa-tasks fa-fw" data-toggle="tooltip" data-placement="top" title="Inventario"></i></a>&nbsp;';
   }
   $listar .= '   </div>';  
   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Subir Reportes</li>';
 
 $mensaje = 0;
 require_once ('mensajes_reportes.php'); 

?>