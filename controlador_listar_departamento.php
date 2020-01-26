<?php

 require_once ('modelo_listar_departamento.php');
 
 $listar = '';
 
 if($i != 1)
 {
  foreach($departamento as $departamentos)
  {
  
   $listar .= ' <tr>';
   
   $listar .= '  <td width="35px">';

   if($departamentos['estado']==0)
   {
    $listar .= '  <a href="controlador_estado_departamento.php?id='.$departamentos['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Inactivo">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    $listar .= '  </a>';
   }
   if($departamentos['estado']==1)
   {
    $listar .= '  <a href="controlador_estado_departamento.php?id='.$departamentos['id'].'" style="text-decoration: none">';
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activo">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    $listar .= '  </a>';
   }
  
   $listar .= '  </td>';
   
   $listar .= '  <td>'.$departamentos['nombre'].'</td>';
   $listar .= '  <td>'.$departamentos['pais'].'</td>';
   $listar .= '  <td>'.$departamentos['zona'].'</td>';
      
   $listar .= '  <td align="right" width="50px">';
		
   $listar .= '   <a href="modificar_departamento.php?id='.$departamentos['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
   $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarDepartamento('.$departamentos['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';

   $listar .= '  </td>';  
   
   $listar .= ' </tr>';
  }
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Par&aacute;metros</li>';
 $miga_pan .= '<li>Departamento</li>';
 
 $mensaje = 0;
 require_once ('mensajes_departamento.php'); 

?>