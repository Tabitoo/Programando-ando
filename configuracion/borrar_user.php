<?php
$conexion = mysqli_connect("127.0.0.1", "root", "");
mysqli_select_db($conexion, "foro");
$usuario = $_POST["id_user"];

$q = "DELETE FROM usuarios WHERE usuario='$usuario'";

if (mysqli_query($conexion, $q)) {
    header("location: deslogueo2.php");
} else {
    echo "error al eliminar usuario";

}








 ?>
