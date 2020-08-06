<?php
session_start();

if ($q = mysqli_connect("127.0.0.1", "root", "")) {
  $titulo = $_POST["titulo"];
  $lenguaje = $_POST["lenguaje"];
  $contenido = $_POST["contenido"];
  $user = $_SESSION["user"];
  $user_id = $_SESSION["user_id"];


  mysqli_select_db($q, "foro");
  $datos = "INSERT INTO post(id, titulo, lenguaje, contenido, user_name, user_id) VALUES ('', '$titulo', '$lenguaje', '$contenido', '$user', '$user_id')";

  if(mysqli_query($q, $datos)) {
    header("location: ../public_post.php");
  } else {
    echo "error al almacenar";
  }


} else {
  echo "error al conectar a base de datos";
}





 ?>
