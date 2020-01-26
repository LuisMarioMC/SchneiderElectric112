<?php
  
 $error = 0;
 $modificar = 0;
 $nombre = '';
 $correo_electronico = '';
 $celular = '';
 $perfil = '';
  
 require_once ('conexion_sesion.php'); 
  
 if($_POST)
 {
  $nombre = trim(mysqli_real_escape_string($conexion,$_POST['nombre']));
  $correo_electronico = trim(mysqli_real_escape_string($conexion,$_POST['correo_electronico']));
  $celular = trim(mysqli_real_escape_string($conexion,$_POST['celular']));
  //$perfil = trim(mysqli_real_escape_string($conexion,$_POST['perfil']));
  
  if($nombre == '')
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Nombre.</div>';
   $error = 1;
  }
  if($correo_electronico == '')
  {
   $error_correo_electronico = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Correo Electr&oacute;nico.</div>';
   $error = 1;
  }
  if($celular == '')
  {
   $error_celular = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Escribir Celular.</div>';
   $error = 1;
  }
  if(!is_numeric($celular))
  {
   $error_celular = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Debe ser Formato Num&eacute;rico.</div>';
   $error = 1;
  }
  //if($perfil == '')
  //{
  // $error_perfil = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>Seleccionar Perfil.</div>';
  // $error = 1;
  //} 
  
  require_once ('modelo_modificar_usuario.php');
    
  if($modificar)
  { 
   $modulo = 2;
   $accion = 'MODIFICAR';
   $id_afectado = $id_modificar;
   $descripcion = 'Modificar segmento '.$nombre.'';
   auditoria($modulo,$accion,$id_afectado,$descripcion);
   $mensaje = 31;
   echo '<script language="JavaScript" type="text/javascript">document.location.href="listar_usuario.php?m='.$mensaje.'"</script>';
  }
  else
  {
   $mensaje = 32; 
  }
 }
 else
 {
  $error = 1;
  require_once ('modelo_modificar_usuario.php');
 }
 
 require_once ('mensajes_usuario.php');
 
 //País
 $menu_pais = '<select id="id_pais" name="id_pais" class="form-control">';
 $menu_pais .= '<option value = ""> Seleccionar ';
 foreach($paises as $pais)
 {
  if($id_pais == $pais['id'])
  {
   $menu_pais .= ' <option value = '.$pais['id'].' selected> '.$pais['nombre'].'</option>';
  }
  else
  {
   $menu_pais .= ' <option value = '.$pais['id'].'> '.$pais['nombre'].'</option>';
  }
 }	
 $menu_pais .= '</select>';
 
 //Línea
 $menu_linea = '<select id="id_linea" name="id_linea" class="form-control">';
 $menu_linea .= '<option value = ""> Seleccionar ';
 foreach($lineas as $linea)
 {
  if($id_linea == $linea['id'])
  {
   $menu_linea .= ' <option value = '.$linea['id'].' selected> '.$linea['nombre'].'</option>';
  }
  else
  {
   $menu_linea .= ' <option value = '.$linea['id'].'> '.$linea['nombre'].'</option>';
  }
 }	
 $menu_linea .= '</select>';
 
 //Actividad
 $menu_actividad = '<select id="id_actividad" name="id_actividad" class="form-control">';
 $menu_actividad .= '<option value = ""> Seleccionar ';
 foreach($actividades as $actividad)
 {
  if($id_actividad == $actividad['id'])
  {
   $menu_actividad .= ' <option value = '.$actividad['id'].' selected> '.$actividad['nombre'].'</option>';
  }
  else
  {
   $menu_actividad .= ' <option value = '.$actividad['id'].'> '.$actividad['nombre'].'</option>';
  }
 }	
 $menu_actividad .= '</select>';
 
 //Zona
 $menu_zona = '<select id="id_zona" name="id_zona" class="form-control">';
 $menu_zona .= '<option value = ""> Seleccionar ';
 foreach($zonas as $zona)
 {
  if($id_zona == $zona['id'])
  {
   $menu_zona .= ' <option value = '.$zona['id'].' selected> '.$zona['nombre'].'</option>';
  }
  else
  {
   $menu_zona .= ' <option value = '.$zona['id'].'> '.$zona['nombre'].'</option>';
  }
 }	
 $menu_zona .= '</select>';
 
 if($perfil == 'segmento')
 {
  $menu_listar = '<th>Pa&iacute;s</th>';
  $menu_listar .= '<th>Segmento</th>';
  $menu_listar .= '<th></th>';
  
  $nombre_perfil = 'Gerente de Segmento';
 
  if($cantidad_segmento_usuarios > 0)
  {
   foreach($segmento_usuario as $segmento_usuarios)
   {
    $listar .= ' <tr>';
    $listar .= '  <td>'.$segmento_usuarios['pais'].'</td>';
    $listar .= '  <td>'.$segmento_usuarios['segmento'].'</td>';	
    $listar .= '  <td align="right" width="30px">';
    $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarSegmentoUsuario('.$segmento_usuarios['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
    $listar .= '  </td>';  
    $listar .= ' </tr>';
   }
  }
 
 }
 
 if($perfil == 'zona')
 {
  $menu_listar = '<th>Pa&iacute;s</th>';
  $menu_listar .= '<th>Zona</th>';
  $menu_listar .= '<th></th>';
  
  $nombre_perfil = 'Gerente de Zona';
 
  if($cantidad_zona_usuarios > 0)
  {
   foreach($zona_usuario as $zona_usuarios)
   {
    $listar .= ' <tr>';
    $listar .= '  <td>'.$zona_usuarios['pais'].'</td>';
    $listar .= '  <td>'.$zona_usuarios['zona'].'</td>';	
    $listar .= '  <td align="right" width="30px">';
    $listar .= '   <a href="#" onclick="return CajaConfirmacionEliminarZonaUsuario('.$zona_usuarios['id'].')" style="text-decoration: none"><img src="img/eliminar.png" border="0" alt="Eliminar"></a>&nbsp;';
    $listar .= '  </td>';  
    $listar .= ' </tr>';
   }
  }
 
 }
 
 $miga_pan = '';
 $miga_pan .= '<li>Usuario</li>';
 
?>