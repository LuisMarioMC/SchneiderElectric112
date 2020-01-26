<?php
 
 $perfil = $_SESSION['perfil'];
 $usuario = $_SESSION['usuario'];
 $fecha_actual = FechaActual();
 $hora_actual = HoraActual();

 if($perfil != 'admin')
 {
  $mensaje = 666;
  echo '<script language="JavaScript" type="text/javascript">document.location.href="index.php?m='.$mensaje.'"</script>';
 }
     
 if($error == 0)
 {
  $consulta_anio = @mysqli_query($conexion,"select * from anio where nombre='$nombre'");
  if(mysqli_num_rows($consulta_anio) == 1)
  {
   $error_nombre = '<br><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error: </strong>El A&ntilde;o ya existe.</div>';
   $error = 1;
  } 
 }
 
 if($error == 0)
 {
  $id_crear = 0;
  $crear = @mysqli_query($conexion,"insert into anio (nombre,estado) values ('$nombre','0')");
  
  $id_crear = mysqli_insert_id($conexion);
  
  if($id_crear !=0)
  {
   $crear = @mysqli_query($conexion,"insert into q (nombre,anio) values ('Q1',$id_crear)");
   $id_q = mysqli_insert_id($conexion);
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Enero','01',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Febrero','02',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Marzo','03',$id_q,$id_crear)");
   
   $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$usuario','$perfil','CREAR Q','$fecha_actual','$hora_actual')");
   
   $crear = @mysqli_query($conexion,"insert into q (nombre,anio) values ('Q2',$id_crear)");
   $id_q = mysqli_insert_id($conexion);
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Abril','04',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Mayo','05',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Junio','06',$id_q,$id_crear)");

   $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$usuario','$perfil','CREAR Q','$fecha_actual','$hora_actual')");

   $crear = @mysqli_query($conexion,"insert into q (nombre,anio) values ('Q3',$id_crear)");
   $id_q = mysqli_insert_id($conexion);
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Julio','07',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Agosto','08',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Septiembre','09',$id_q,$id_crear)");
   
   $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$usuario','$perfil','CREAR Q','$fecha_actual','$hora_actual')");

   $crear = @mysqli_query($conexion,"insert into q (nombre,anio) values ('Q4',$id_crear)");
   $id_q = mysqli_insert_id($conexion); 
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Octubre','10',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Noviembre','11',$id_q,$id_crear)");
   $crear = @mysqli_query($conexion,"insert into mes (estado,nombre,mes,q,anio) values ('0','Diciembre','12',$id_q,$id_crear)");
  
   $auditoria = mysqli_query($conexion,"insert into auditoria_q (q,usuario,perfil,accion,fecha,hora) values ('$id_q','$usuario','$perfil','CREAR Q','$fecha_actual','$hora_actual')");
  }
 }
 
?>