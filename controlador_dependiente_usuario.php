<?php
 
 require_once ('conexion_sesion.php');

 $perfil = $_POST['perfil'];
 $tipo = $_POST['tipo'];
 $id_pais = $_POST['id_pais'];

 $html = '';
 
 if($perfil == "canal")
 {
  $html .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  $html .= ' <div class="form-group">';
  $html .= '  <label>Pa&iacute;s</label>';
  $html .= '  <select id="pais" name="pais" class="form-control" required>';
  $html .= '   <option value="">Seleccionar</option>';

  $consulta_pais = @mysqli_query($conexion,"select * from pais where estado =  1 order by nombre ASC ");
  while($resultado_consulta_pais = @mysqli_fetch_array($consulta_pais))
  {
   if($id_pais == $resultado_consulta_pais['id'])
   { 
    $html .= ' <option value="'.$resultado_consulta_pais['id'].'" selected>'.$resultado_consulta_pais['nombre'].'</option>';
   }
   else
   {
    $html .= ' <option value="'.$resultado_consulta_pais['id'].'">'.$resultado_consulta_pais['nombre'].'</option>';
   }
  }
  $html .= '  </select>';
  $html .= ' </div>';
  $html .= '</div>';
 }
 
 if($perfil == "linea")
 {
   $html .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
   $html .= ' <div class="form-group">';
   $html .= '  <label>L&iacute;nea</label>';
   $html .= '  <select id="linea" name="linea" class="form-control" required>';
   $html .= '   <option value="">Seleccionar</option>';

   $consulta_linea = @mysqli_query($conexion,"select * from linea where estado =  1 order by nombre ASC ");
   while($resultado_consulta_linea = @mysqli_fetch_array($consulta_linea))
   {
    if($id_linea == $resultado_consulta_linea['id'])
    { 
     $html .= ' <option value="'.$resultado_consulta_linea['id'].'" selected>'.$resultado_consulta_linea['nombre'].'</option>';
    }
    else
    {
     $html .= ' <option value="'.$resultado_consulta_linea['id'].'">'.$resultado_consulta_linea['nombre'].'</option>';
    }
   }
   $html .= '  </select>';
   $html .= ' </div>';
   $html .= '</div>';
 }
 
 if($perfil == "distribuidor")
 {  
  if($tipo == "pais")
  {
   $html .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
   $html .= ' <div class="form-group">';
   $html .= '  <label>Pa&iacute;s</label>';
   $html .= '  <select id="pais" name="pais" class="form-control" required>';
   $html .= '   <option value="">Seleccionar</option>';

   $consulta_pais = @mysqli_query($conexion,"select * from pais where estado =  1 order by nombre ASC ");
   while($resultado_consulta_pais = @mysqli_fetch_array($consulta_pais))
   {
    if($id_pais == $resultado_consulta_pais['id'])
    {
     $html .= ' <option value="'.$resultado_consulta_pais['id'].'" selected>'.$resultado_consulta_pais['nombre'].'</option>';
    }
    else
    {
     $html .= ' <option value="'.$resultado_consulta_pais['id'].'">'.$resultado_consulta_pais['nombre'].'</option>';
    }
   }
   $html .= '  </select>';
   $html .= ' </div>';
   $html .= '</div>';
  }
  
  if($tipo == "zona")
  {
   $html .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
   $html .= ' <div class="form-group">';
   $html .= '  <label>Zona</label>';
   $html .= '  <select id="zona" name="zona" class="form-control" required>';
   $html .= '   <option value="">Seleccionar</option>';

   $consulta_zona = @mysqli_query($conexion,"select * from zona where pais = $id_pais and estado = 1 order by nombre ASC ");
   while($resultado_consulta_zona = @mysqli_fetch_array($consulta_zona))
   {
    if($id_zona == $resultado_consulta_zona['id'])
    { 
     $html .= ' <option value="'.$resultado_consulta_zona['id'].'" selected>'.$resultado_consulta_zona['nombre'].'</option>';
    }
    else
    {
     $html .= ' <option value="'.$resultado_consulta_zona['id'].'">'.$resultado_consulta_zona['nombre'].'</option>';
    }
   }
   $html .= '  </select>';
   $html .= ' </div>';
   $html .= '</div>';
  }
  
 }
 
 echo $html;

?>