<?php

 require_once ('modelo_listar_detalle_inventario.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($detalle as $detalles)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($detalles['error']==0)
   {
    $listar .= '  <a href="controlador_estado_detalle_inventario.php?id='.$detalles['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Sin Errores">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
   else
   {
    $listar .= '  <a href="controlador_estado_detalle_inventario.php?id='.$detalles['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Con Errores">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';

   // Producto
   if($detalles['error_producto'] == 0)
   {
    $listar .= '  <td>'.$detalles['producto'].'</td>';
   }   
   elseif($detalles['error_producto'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Producto"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_producto'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="No Existe el Producto"><font color="red">'.$detalles['producto'].'</font></div></td>';
   }
 
   // Unidades
   if($detalles['error_unidades'] == 0)
   {
    $listar .= '  <td>'.$detalles['unidades'].'</td>';
   }
   elseif($detalles['error_unidades'] == 1)
   {
    $listar .= '  <td align="center"><div data-toggle="popover" data-placement="top" data-content="Ingresar Unidades"><i class="fa fa-question-circle fa-lg" style="color:red"></i></div></td>';
   }
   elseif($detalles['error_unidades'] == 2)
   {
    $listar .= '  <td><div data-toggle="popover" data-placement="top" data-content="Dato No Numerico"><font color="red">'.$detalles['unidades'].'</font></div></td>';
   }
      
   //Sucursal
   $listar .= '  <td>'.$detalles['sucursal'].'</td>';

   //M1
   $listar .= '  <td>'.$detalles['m1'].'</td>';


   //M2
   $listar .= '  <td>'.$detalles['m2'].'</td>';


   //M3
   $listar .= '  <td>'.$detalles['m3'].'</td>';
   $listar .= '  <td align="right" width="40px">';
		
   $listar .= '   <a href="modificar_detalle_inventario.php?id='.$detalles['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
  
 $mensaje = 0;
 require_once ('mensajes_detalle_inventario.php'); 

?>