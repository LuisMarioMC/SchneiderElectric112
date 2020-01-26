<?php

 require_once ('conexion_sesion.php');
  
 if($_SESSION['perfil'] != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
 
 $id_reporte_inventario = !empty($_GET['id'])? $_GET['id']:0;
 
 $i = 1;

 $consulta_detalle_inventario = mysqli_query($conexion,"select * from detalle_inventario where reporte_inventario = $id_reporte_inventario order by id desc"); 
 while ($resultado_consulta_detalle_inventario = mysqli_fetch_array($consulta_detalle_inventario))
 {
  $detalle[$i]['error'] = 0;
 
  // Id
  $detalle[$i]['id'] = $resultado_consulta_detalle_inventario['id'];
  $id_detalle_inventario = $resultado_consulta_detalle_inventario['id'];
    
  // Producto
  $detalle[$i]['error_producto'] = 0;
  $detalle[$i]['producto'] = $resultado_consulta_detalle_inventario['producto'];
  $producto = $resultado_consulta_detalle_inventario['producto'];
  $id_producto = $resultado_consulta_detalle_inventario['id_producto'];

  if ($producto == '')
  {
   $detalle[$i]['error_producto'] = 1;
   $detalle[$i]['error']++;
  }
  else
  {
   if($id_producto == 0)
   {
    $consulta_producto = mysqli_query($conexion,"select * from producto where referencia = '$producto'");   
    if(mysqli_num_rows($consulta_producto)==0)
    {
     $detalle[$i]['error_producto'] = 2;
     $detalle[$i]['error']++;
    }
    else
    {
     $resultado_consulta_producto = mysqli_fetch_array($consulta_producto);
     $id_producto = $resultado_consulta_producto['id'];
     $modificar = @mysqli_query($conexion,"update detalle_inventario set id_producto = '$id_producto' where id = '$id_detalle_inventario'");
    }
   } 
  }
  
  // Unidades
  $detalle[$i]['error_unidades'] = 0;
  $detalle[$i]['unidades'] = $resultado_consulta_detalle_inventario['unidades'];
  $unidades = $resultado_consulta_detalle_inventario['unidades'];
  if($unidades == '')
  {
   $detalle[$i]['error_unidades'] = 1;
   $detalle[$i]['error']++;  
  }
  else
  {  
   if(!is_numeric($unidades)) 
   {
    $detalle[$i]['error_unidades'] = 2;
    $detalle[$i]['error']++;
   }
  }

  //Sucursal
  $detalle[$i]['error_sucursal'] = 0;
   $detalle[$i]['sucursal'] = $resultado_consulta_detalle_inventario['sucursal'];
  //M1
  $detalle[$i]['error_m1'] = 0;
  $detalle[$i]['m1'] = $resultado_consulta_detalle_inventario['m1'];

  //M2
  $detalle[$i]['error_m2'] = 0;
  $detalle[$i]['m2'] = $resultado_consulta_detalle_inventario['m2'];

  //M3
  $detalle[$i]['error_m3'] = 0;
  $detalle[$i]['m3'] = $resultado_consulta_detalle_inventario['m3'];



  // Estado  
  $detalle[$i]['estado'] = $resultado_consulta_detalle_inventario['estado'];
  
  $i++;
 }

?>