<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $i = 1;

 $consulta_moneda = mysqli_query($conexion,"select * from moneda order by id desc");
 
 while ($resultado_consulta_moneda = mysqli_fetch_array($consulta_moneda))
 {
  // Id
  $moneda[$i]['id'] = $resultado_consulta_moneda['id'];

  // Estado
  $moneda[$i]['estado'] = $resultado_consulta_moneda['estado'];
  
  // Nombre
  $moneda[$i]['nombre'] = $resultado_consulta_moneda['nombre'];
   
  // Sigla
  $moneda[$i]['sigla'] = $resultado_consulta_moneda['sigla'];
      
  $i++;
 }

?>