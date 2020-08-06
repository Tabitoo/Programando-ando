<?php

$usuario = $_POST["user"];
$contraseña = $_POST["pass"];

if($conexion = mysqli_connect("127.0.0.1", "root", "")) {

  mysqli_select_db($conexion, "foro");


  if ($q= "SELECT*FROM usuarios WHERE usuario='$usuario' and contraseña = '$contraseña'") {
    $reg= mysqli_query($conexion, $q);
    $datos= mysqli_fetch_array($reg);
    $mail = $datos["correo"];
    $level = $datos["user_lvl"];
    $user_id = $datos["id"];


    if ($datos["usuario"] == $usuario && $datos["contraseña"] == $contraseña ) {
      session_start();
      $_SESSION["user"] = $usuario;
      $_SESSION["pass"] = $contraseña;
      $_SESSION["mail"] = $mail;
      $_SESSION["level"] = $level;
      $_SESSION["user_id"] = $user_id;

      header("Location: ../home.php");

    }  else {
      echo "usuario o contraseña incorrecta";
    }

  }else {
    echo "Usuario no registrado";
  };



} else {
  echo "error al conectar a la base de datos";
}






 ?>
