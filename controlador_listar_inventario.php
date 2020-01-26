<?php 
 require_once ('modelo_listar_inventario.php');
 
 $listar = '';
 
 if($cantidad_inventarios > 0)
 {
  foreach($inventario as $inventarios)
  {
   $listar .= ' <tr>';
   $listar .= '  <td>'.$inventarios['material'].'</td>';
   $listar .= '  <td>'.$inventarios['existencia'].'</td>';
   $listar .= '  <td>'.$inventarios['existencia_mts'].'</td>';  
	
   $listar .= '  <td align="right" width="70px">';
   $listar .= '   <a href="controlador_cambiar_inventario.php?id='.$inventarios['id'].'" style="text-decoration: none" data-toggle="tooltip" title="Cambiar Usuario"><i class="fa fa-exchange fa-fw"></i></a>&nbsp;';
   $listar .= '   <a href="modificar_inventario.php?id='.$inventarios['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarUsuario('.$inventarios['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
   $listar .= '  </td>';  
   $listar .= ' </tr>';
  }
 }
 
 $menu_listar = '';
 $menu_listar .= '<th>Material</th>';
 $menu_listar .= '<th>Existencia</th>';
 $menu_listar .= '<th>Existencia Mts</th>';
 $menu_listar .= '<th></th>';
 
 $miga_pan = '';
 $miga_pan .= '<li>Inventario</li>';
 
 //$miga_pan .= '<li>Dashboard</li>';
 //$miga_pan .= '<li>'.$nombre_evento.'</li>';
 
 $mensaje = 0;
 require_once ('mensajes_inventario.php'); 

?>