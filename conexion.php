<?php 
// $bdservidor = '199.168.185.134:3306';
// $bdusuario = 'rootschneider';
// $bdcontrasenia = '6rGF5g8B9r6qCi*';
 $bdservidor = 'localhost';
 $bdusuario = 'root';
 $bdcontrasenia = '';
$bd = 'latone_schneider';
 $conexion = @mysqli_connect($bdservidor,$bdusuario,$bdcontrasenia,$bd);

 @mysqli_select_db($bd,$conexion);
/* comprueba la conexión */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
