<?php
 
 require_once ('conexion_sesion.php');

 $id_linea = $_POST['id_linea'];
 $id_actividad = $_POST['id_actividad'];
 
 $html = '<option value="">Seleccionar</option>';

 $consulta_actividad = @mysqli_query($conexion,"select * from actividad where linea = $id_linea and estado =  1 order by nombre ASC ");
 while($resultado_consulta_actividad = mysqli_fetch_array($consulta_actividad))
 {
  if($id_actividad == $resultado_consulta_actividad['id'])
  { 
   $html .= '<option value="'.$resultado_consulta_actividad['id'].'" selected>'.$resultado_consulta_actividad['nombre'].'</option>';
  }
  else
  { 
   $html .= '<option value="'.$resultado_consulta_actividad['id'].'">'.$resultado_consulta_actividad['nombre'].'</option>';
  }
 }
 echo $html;

?>