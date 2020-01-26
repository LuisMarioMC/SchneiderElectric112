<?php
 
 require_once ('conexion_sesion.php');

 $id_pais = $_POST['id_pais'];
 $id_zona = $_POST['id_zona'];
 
 $html = '<option value="">Seleccionar</option>';

 $consulta_zona = @mysqli_query($conexion,"select * from zona where pais = $id_pais and estado =  1 order by nombre ASC ");
 while($resultado_consulta_zona = @mysqli_fetch_array($consulta_zona))
 {
  if($id_zona == $resultado_consulta_zona['id'])
  { 
   $html .= '<option value="'.$resultado_consulta_zona['id'].'" selected>'.$resultado_consulta_zona['nombre'].'</option>';
  }
  else
  { 
   $html .= '<option value="'.$resultado_consulta_zona['id'].'">'.$resultado_consulta_zona['nombre'].'</option>';
  }
 }
 echo $html;

?>