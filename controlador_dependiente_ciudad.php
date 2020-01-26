<?php
 
 require_once ('conexion_sesion.php');

 $id_pais = $_POST['id_pais'];
 $id_departamento = $_POST['id_departamento'];
 
 $html = '<option value="">Seleccionar</option>';

 $consulta_departamento = @mysqli_query($conexion,"select * from departamento where pais = $id_pais and estado =  1 order by nombre ASC ");
 while($resultado_consulta_departamento = @mysqli_fetch_array($consulta_departamento))
 {
  if($id_departamento == $resultado_consulta_departamento['id'])
  { 
   $html .= '<option value="'.$resultado_consulta_departamento['id'].'" selected>'.$resultado_consulta_departamento['nombre'].'</option>';
  }
  else
  { 
   $html .= '<option value="'.$resultado_consulta_departamento['id'].'">'.$resultado_consulta_departamento['nombre'].'</option>';
  }
 }
 echo $html;

?>