<?php

 $error = 0;
 $crear = 0;
 
 $documento_reporte_ventas = '';
 $id_distribuidor = 0;
 $id_mes = 0;

 require_once ('conexion_sesion.php');

 if($_POST)
 {
  $documento_reporte_ventas = basename($_FILES["reporte_ventas"]["name"]);
  $id_mes = isset($_POST['id_mes']) ? trim(mysqli_real_escape_string($conexion,$_POST['id_mes'])) : '0';
  $id_distribuidor = isset($_POST['id_distribuidor']) ? trim(mysqli_real_escape_string($conexion,$_POST['id_distribuidor'])) : '0';

  $error_reporte_ventas = '';
  $error_mes = '';
  $error_distribuidor = '';
  
  if($documento_reporte_ventas == '')
  {
   $error_reporte_ventas = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Subir Reporte de Ventas.</div>';
   $error = 1;
  }
  if($id_mes == 0)
  {
   $error_mes = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Mes.</div>';
   $error = 1;
  }
  if($id_distribuidor == 0)
  {
   $error_distribuidor = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Distribuidor.</div>';
   $error = 1;
  }
  
  require_once ('modelo_reporte_ventas.php');
  
  if($crear)
  {
   $modulo = 2;
   $accion = 'CREAR';
   $id_afectado = mysqli_insert_id($conexion);
   $descripcion = 'Crear Actividad '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 21;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="reporte_ventas.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 22;
  }

 }
 else
 {
  $error = 1;
  require_once ('modelo_reporte_ventas.php');
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
 
 $menu_distribuidor = '<select id="id_distribuidor" name="id_distribuidor" class="form-control" required/>';
 $menu_distribuidor .= '<option value = ""> Seleccionar ';
 if($cantidad_distribuidor != 1)
 {
  foreach($distribuidores as $distribuidor)
  { 
   if($id_distribuidor == $distribuidor['id'])
   {
    $menu_distribuidor .= ' <option value = '.$distribuidor['id'].' selected> '.$distribuidor['nombre'].'</option>';
   }
   else
   {
    $menu_distribuidor .= ' <option value = '.$distribuidor['id'].'> '.$distribuidor['nombre'].'</option>';
   }
  }
 }
 $menu_distribuidor .= '</select>';
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($reporte as $reportes)
  {  
   $listar .= ' <tr>';

   $listar .= '  <td width="35px">';

   if($reportes['estado'] == 0)
   {
    if($reportes['registros_error'] == 0)
    {
     $listar .= '   <a href="controlador_estado_reporte_ventas.php?id='.$reportes['id'].'" style="text-decoration: none">';
    }
    $listar .= '    &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="En Revision">';
    $listar .= '    <font size="1" color="#FFFFFF">0</font>';
    if($reportes['registros_error'] == 0)
    {
     $listar .= '   </a>';
    }
   }
   if($reportes['estado'] == 1)
   {
    $listar .= '   <a href="controlador_estado_reporte_ventas.php?id='.$reportes['id'].'" style="text-decoration: none">';
	$listar .= '    &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Finalizado">';
    $listar .= '    <font size="1" color="#FFFFFF">1</font>';
    $listar .= '   </a>';
   }
   $listar .= '   </a>';
   
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$reportes['nombre_estado'].'</td>';
   $listar .= '  <td>'.$reportes['mes'].'</td>';
   $listar .= '  <td>'.$reportes['distribuidor'].'</td>';
   $listar .= '  <td>'.$reportes['fecha'].'</td>';
   $listar .= '  <td>'.$reportes['hora'].'</td>';
   
   $listar .= '  <td align="right" width="30px">';
		
   $listar .= '   <a href="listar_detalle_sell_out.php?id='.$reportes[id].'" style="text-decoration: none"><i class="fa fa-arrow-right fa-fw"></i></a>&nbsp;';
   
   $listar .= '  </td>';

   $listar .= '  <td align="right" width="30px">';
		
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarReporte('.$reportes['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
   
   $listar .= '  </td>';   
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Subir Reportes</li>';
 
 $mensaje = 0;
 require_once ('mensajes_reporte_ventas.php'); 

?>