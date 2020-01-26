<?php 
 require_once ('modelo_listar_usuario.php');
 
 $listar = '';
 
 if($cantidad_usuarios > 0)
 {
  foreach($usuario as $usuarios)
  {
   $listar .= ' <tr>';
  
   $listar .= '  <td width="35px">';

   if($usuarios['estado']==0)
   {
    if($_SESSION['perfil']=='admin')
    {
     $listar .= '  <a href="controlador_estado_usuario.php?id='.$usuarios['id'].'" style="text-decoration: none">';
    }
    $listar .= '   &nbsp;&nbsp;<img src="img/inactivo.png" border="0" alt="Activa">';
    $listar .= '   <font size="1" color="#FFFFFF">0</font>';
    if($_SESSION['perfil']=='admin')
    {
     $listar .= '  </a>';
    }
   }
   if($usuarios['estado']==1)
   {
    if($_SESSION['perfil']=='admin')
    {
     $listar .= '  <a href="controlador_estado_usuario.php?id='.$usuarios['id'].'" style="text-decoration: none">';
    }   
    $listar .= '   &nbsp;&nbsp;<img src="img/activo.png" border="0" alt="Activa">';
    $listar .= '   <font size="1" color="#FFFFFF">1</font>';
    if($_SESSION['perfil']=='admin')
    {
     $listar .= '  </a>';
    }
   }
  
   $listar .= '  </td>';
   if($usuarios['perfil'] == 'vendedor')
   {
    $listar .= '  <td>'.$usuarios['id'].'</td>';
   }
   else
   {
    $listar .= '  <td></td>';
   }	   
   $listar .= '  <td>'.$usuarios['nombre'].'</td>';
   $listar .= '  <td>'.$usuarios['correo_electronico'].'</td>';
   $listar .= '  <td>'.$usuarios['celular'].'</td>';  
   $listar .= '  <td>'.$usuarios['perfil'].'</td>';
   $listar .= '  <td>'.$usuarios['opcion'].'</td>';	
	
   $listar .= '  <td align="right" width="120px">';
   
   if($_SESSION['perfil']=='admin')
   {
    $listar .= '   <a href="cambiar_contrasenia_usuario.php?id='.$usuarios['id'].'" style="text-decoration: none" data-toggle="tooltip" title="Cambiar Contraseña"><i class="fa fa-key fa-fw"></i></a>&nbsp;';
   }
   $listar .= '   <a href="controlador_cambiar_usuario.php?id='.$usuarios['id'].'" style="text-decoration: none" data-toggle="tooltip" title="Cambiar Usuario"><i class="fa fa-exchange fa-fw"></i></a>&nbsp;';
   if($_SESSION['perfil']=='admin')
   {
    $listar .= '   <a href="modificar_usuario.php?id='.$usuarios['id'].'" style="text-decoration: none"><img src="img/modificar.png" border="0" alt="Modificar"></a>&nbsp;';
    $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarUsuario('.$usuarios['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
   }   
   $listar .= '  </td>';  
   $listar .= ' </tr>';
  }
 }
 
 $menu_listar = '';
 $menu_listar .= '<th></th>';
 $menu_listar .= '<th>ID</th>';
 $menu_listar .= '<th>Nombre</th>';			
 $menu_listar .= '<th>Correo Electr&oacute;nico</th>';
 $menu_listar .= '<th>Celular</th>';
 $menu_listar .= '<th>Perfil</th>';
 $menu_listar .= '<th>Opci&oacute;n</th>';
 $menu_listar .= '<th></th>';
 
 $miga_pan = '';
 $miga_pan .= '<li>Usuario</li>';
 
 $mensaje = 0;
 require_once ('mensajes_usuario.php'); 

?>