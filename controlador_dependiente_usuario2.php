<?php
 
 require_once ('conexion_sesion.php');

 $perfil = $_POST['perfil'];
 $tipo = $_POST['tipo'];
 $id_pais = $_POST['id_pais'];

 $html = '';
 
 if($perfil == "distribuidor" || $perfil == "segmento" || $perfil == "zona")
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
    if($pais == $resultado_consulta_pais['id'])
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
  
  if($tipo == "segmento")
  {
   $html .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
   $html .= ' <div class="form-group">';
   $html .= '  <label>Segmento</label>';
   $html .= '  <select id="segmento" name="segmento" class="form-control" required>';
   $html .= '   <option value="">Seleccionar</option>';

   $consulta_segmento = @mysqli_query($conexion,"select * from segmento where estado = 1 order by nombre ASC ");
   while($resultado_consulta_segmento = @mysqli_fetch_array($consulta_segmento))
   {
    if($segmento == $resultado_consulta_segmento['id'])
    {
     $html .= ' <option value="'.$resultado_consulta_segmento['id'].'" selected>'.$resultado_consulta_segmento['nombre'].'</option>';
    }
    else
    {
     $html .= ' <option value="'.$resultado_consulta_segmento['id'].'">'.$resultado_consulta_segmento['nombre'].'</option>';
    }
   }
   $html .= '  </select>';
   $html .= ' </div>';
   $html .= '</div>';
  }
  
 }
 
 echo $html;

?>