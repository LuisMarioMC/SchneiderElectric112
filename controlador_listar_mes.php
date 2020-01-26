<?php

 require_once ('modelo_listar_mes.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($mes as $meses)
  {
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($meses['estado']==0)
   {
    $listar .= '  <a href="controlador_estado_mes.php?id='.$meses['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Inactivo">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
   if($meses['estado']==1)
   {
    $listar .= '  <a href="controlador_estado_mes.php?id='.$meses['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$meses['nombre'].'</td>';
   $listar .= '  <td>'.$meses['anio'].'</td>';
     
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Mes</li>';
 
 $mensaje = 0;
 require_once ('mensajes_mes.php'); 

?>