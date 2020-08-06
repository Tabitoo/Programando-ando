<?php
session_start();
$user_session = $_SESSION["user"];
$conexion = mysqli_connect("127.0.0.1", "root", "");
$usuario = $_POST["usuario"];
$correo = $_POST["correo"];
$new_password = $_POST["new_password"];
$contraseña2 = $_POST["password2"];
$contraseña1 = $_POST["password1"];

mysqli_select_db($conexion, "foro");
//se preparan las ordenes
$q = "SELECT * FROM usuarios";
$new_q = "UPDATE usuarios SET usuario='$usuario', correo='$correo', contraseña='$new_password' WHERE usuario='$user_session'";
//Se verifica que la contraseña sea correcta para poder modificar los datos
if($contraseña1 == $contraseña2) {
  $reg = mysqli_query($conexion, $q);
  // Se inicia un bucle que itera sobre todos los nombres de usuarios y correos almacenas para corroborar que los datos ingresados sean unicos
  while ($datos = mysqli_fetch_array($reg)) {
    if ($datos["usuario"] == $usuario) {
      echo "ese usuario ya esta en la base de datos";
      exit();
    } elseif ($datos["correo"] == $correo) {
      echo "ese correo ya esta en la base de datos";
      exit();
    }
  }
  if (empty($usuario)) {
    $orden = "UPDATE usuario SET correo='$correo', contraseña='$new_password' WHERE usuario='$user_session'";
    mysqli_query($conexion, $orden);
  } elseif (empty($correo)) {
    $orden = "UPDATE usuario SET usuario='$usuario', contraseña='$new_password' WHERE usuario='$user_session'";
    mysqli_query($conexion, $orden);
  }

  if (mysqli_query($conexion, $new_q)) {
    echo "cambios realizado";
  } else {
    echo "error al realizar cambios";
  }




} else {
  echo "contraseña incorrecta";
}




?>
