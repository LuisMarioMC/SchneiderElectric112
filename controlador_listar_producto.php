<?php

 $referencia = '';
 $nombre = ''; 

 if($_POST)
 {
  $referencia = isset($_POST['referencia']) ? $_POST['referencia'] : '';
  $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : ''; 
 }
 
 if($referencia == '' && $nombre == '') 
 {
  
 }
 else
 {
  require_once ('modelo_listar_producto.php'); 
	 
  $listar = '';
 
  if($i != 1)
  {
   foreach($producto as $productos)
   {
    $sell_out_checked = '';
  
    $listar .= ' <tr>';
   
    $listar .= '  <td width="35px">';

    if($productos['estado']==0)
    {
     $listar .= '  <a href="controlador_estado_producto.php?id='.$productos['id'].'" style="text-decoration: none">';
     $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Inactivo">';
     $listar .= '   <font size="1" color="#FFFFFF">0</font>';
     $listar .= '  </a>';
    }
    if($productos['estado']==1)
    {
     $listar .= '  <a href="controlador_estado_producto.php?id='.$productos['id'].'" style="text-decoration: none">';
     $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
     $listar .= '   <font size="1" color="#FFFFFF">1</font>';
     $listar .= '  </a>';
    }
  
    $listar .= '  </td>';
   
    $listar .= '  <td>'.$productos['referencia'].'</td>';
    $listar .= '  <td>'.$productos['nombre'].'</td>';
    $listar .= '  <td>'.$productos['actividad'].'</td>';
    $listar .= '  <td>'.$productos['cant_indi'].'</td>';   
 
    $listar .= '  <td align="right" width="50px">';
		
    $listar .= '   <a href="modificar_producto.php?id='.$productos['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
    $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarProducto('.$productos['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';

    $listar .= '  </td>';  
   
    $listar .= ' </tr>';
   }
  }
 
 }	 
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Producto</li>';
 
 $mensaje = 0;
 require_once ('mensajes_producto.php'); 

?>