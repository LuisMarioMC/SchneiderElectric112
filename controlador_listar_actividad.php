<?php

 require_once ('modelo_listar_actividad.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($actividad as $actividades)
  {
   $sell_out_checked = '';
  
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($actividades['estado']==0)
   {
    $listar .= '  <a href="controlador_estado_actividad.php?id='.$actividades['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Inactivo">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
   if($actividades['estado']==1)
   {
    $listar .= '  <a href="controlador_estado_actividad.php?id='.$actividades['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$actividades['nombre'].'</td>';
   $listar .= '  <td>'.$actividades['linea'].'</td>';

   if($actividades['sell_out'] == 1)
   {
    $sell_out_checked = 'checked';
   }
   
   $listar .= '  <td align="center" width="80px"><input type="checkbox" '.$sell_out_checked.' disabled></td>';

   $listar .= '  <td align="right" width="50px">';
		
   $listar .= '   <a href="modificar_actividad.php?id='.$actividades['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarActividad('.$actividades['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Actividad</li>';
 
 $mensaje = 0;
 require_once ('mensajes_actividad.php'); 

?>