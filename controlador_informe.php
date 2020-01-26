<?php
  
 $error = 0;
 $crear = 0;
 
 $fecha_inicial = '';
 $fecha_final = '';
  
 require_once ('conexion_sesion.php');
 
 if($_POST)
 {
  $fecha_inicial = trim(mysqli_real_escape_string($conexion,$_POST['fecha_inicial']));
  $fecha_final = trim(mysqli_real_escape_string($conexion,$_POST['fecha_final']));
 
  $error_fecha_inicial = '';
  $error_fecha_final = '';
 
  if($fecha_inicial == '')
  {
   $error_fecha_inicial = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Ingresar Fecha Inicial.</div>';
   $error = 1;
  }
  
  if($fecha_final == '')
  {
   $error_fecha_final = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Ingresar Fecha Final.</div>';
   $error = 1;
  }
    
  require_once ('modelo_informe.php');
    
  $resultado = '';
	
  if($consulta_informe)
  {
   //$modulo = 2;
   //$accion = 'CREAR';
   //$id_afectado = mysqli_insert_id($conexion);
   //$descripcion = 'Crear anio '.$nombre.'';
   //auditoria($modulo,$accion,$id_afectado,$descripcion);
   
   if($cantidad_registros > 0)
   {
	$resultado .= '<br>';
	$resultado .= '<div class="alert alert-success">';
    $resultado .= ' Se encontraron: <b>'.$cantidad_registros.'</b> registros.'; 
	$resultado .= ' &nbsp;&nbsp;<a class="btn btn-success" href="descargar_informe.php?fecha_inicial='.$fecha_inicial.'&fecha_final='.$fecha_final.'">Descargar Informe</a>';
    $resultado .= '</div>';
    $mensaje = 11;
   }
   else
   {
   	$resultado .= '<br>';
	$resultado .= '<div class="alert alert-danger">';
    $resultado .= ' Se encontraron: <b>'.$cantidad_registros.'</b> registros.'; 
    $resultado .= '</div>';
    $mensaje = 12;	   
   }
  }
  require_once ('mensajes_informe.php');
 }
 else
 {
  $error = 1;
  require_once ('modelo_informe.php');  
 }
 
?>