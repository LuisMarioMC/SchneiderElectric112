<?php
 require_once ('conexion_sesion.php');
 
 if($_SESSION['perfil'] != 'distribuidor')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $id_distribuidor = 0;
 $id_distribuidor = $_SESSION['usuario'];
 if($id_distribuidor == 0)
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $cantidad_vendedores = 0;

 $consulta_vendedor = mysqli_query($conexion,"select * from usuario where perfil = 'vendedor' and distribuidor = '$id_distribuidor' order by id desc");
 
 while ($resultado_consulta_vendedor = mysqli_fetch_array($consulta_vendedor))
 {
  // Id
  $vendedor[$cantidad_vendedores]['id'] = $resultado_consulta_vendedor['id'];

  // Estado
  $vendedor[$cantidad_vendedores]['estado'] = $resultado_consulta_vendedor['estado'];

  // Nombre
  $vendedor[$cantidad_vendedores]['nombre'] = $resultado_consulta_vendedor['nombre'];
  
  // Correo Electrónico
  $vendedor[$cantidad_vendedores]['correo_electronico'] = $resultado_consulta_vendedor['correo_electronico'];

  // Celular
  $vendedor[$cantidad_vendedores]['celular'] = $resultado_consulta_vendedor['celular'];
    
  $cantidad_vendedores++;
 }
 
?>