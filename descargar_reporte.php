<?php

 require_once ('conexion_sesion.php');

 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil'] != 'distribuidor')
 {
  $mensaje = 660;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $id_reporte = !empty($_GET['id'])? mysqli_real_escape_string($conexion,$_GET['id']):0;
 $tipo = !empty($_GET['tipo'])? mysqli_real_escape_string($conexion,$_GET['tipo']):0;

 if($id_reporte == 0 || $tipo == 0)
 {
  $mensaje = 661;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $consulta_reporte = mysqli_query($conexion,"select * from reporte where id = $id_reporte");
 $resultado_consulta_reporte = mysqli_fetch_array($consulta_reporte);
 
 if($_SESSION['perfil'] == 'distribuidor')
 {
  $id_distribuidor = $_SESSION['usuario'];
  $distribuidor = $resultado_consulta_reporte['distribuidor'];
  
  if($id_distribuidor != $distribuidor)
  {
   $mensaje = 662;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
  }
 }
 
 if($tipo == 1)
 {
  $reporte_ventas = 'reporte_ventas/'.$resultado_consulta_reporte['reporte_ventas'];
    
  if (file_exists($reporte_ventas)) 
  {
   header('Content-Disposition: attachment;filename="'.$resultado_consulta_reporte[reporte_ventas].'"');
   header('Content-Type: application/vnd.ms-excel');
   header('Content-Length: '.filesize($reporte_ventas));
   header('Cache-Control: max-age=0');
   readfile($reporte_ventas);
   
   if($_SESSION['perfil'] == 'admin')
   { 
    $modificar = @mysqli_query($conexion,"update reporte set estado = '1' where id = $id_reporte");
   }
  }

  exit;
 }
 elseif($tipo == 2)
 {
  $reporte_inventario = 'reporte_inventario/'.$resultado_consulta_reporte['reporte_inventario'];	 

  if (file_exists($reporte_inventario)) 
  {
   header('Content-Disposition: attachment;filename="'.$resultado_consulta_reporte[reporte_inventario].'"');
   header('Content-Type: application/vnd.ms-excel');
   header('Content-Length: '.filesize($reporte_inventario));
   header('Cache-Control: max-age=0');
   readfile($reporte_inventario);

   if($_SESSION['perfil'] == 'admin')
   {
    $modificar = @mysqli_query($conexion,"update reporte set estado = '1' where id = $id_reporte");
   }
  }
  
  exit;
 } 
 else
 {
  $mensaje = 663;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>'; 
 }

?>