<?php
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'admin' && $_SESSION['perfil'] != 'admin_schneider' && $_SESSION['perfil'] != 'super_schneider')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_reportes = 0;
 
 $consulta_reporte = mysqli_query($conexion,"select * from descargar_reporte order by id desc");
 
 while ($resultado_consulta_reporte = mysqli_fetch_array($consulta_reporte))
 {
  // Id
  $reporte[$cantidad_reportes]['id'] = $resultado_consulta_reporte['id'];

  // Nombre
  $reporte[$cantidad_reportes]['nombre'] = $resultado_consulta_reporte['nombre'];

  // Tipo
  $reporte[$cantidad_reportes]['tipo'] = $resultado_consulta_reporte['tipo'];

   
  $cantidad_reportes++;
 }
  
?>