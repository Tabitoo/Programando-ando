<?php
if($conexion = mysqli_connect("127.0.0.1", "root", "")) {

  $user = $_POST["user"];
  $correo = $_POST["correo"];
  $password = $_POST["pass"];

  $array = array(
    "user" => $user,
    "correo" => $correo,
    "pass" => $password);

  // recorre todos los datos ingresados para corroborar que no esten vacios
  foreach ($array as $key => $value) {
          if (empty($value)) {
            echo "formulario incompleto";
            echo "<br>";
            echo "<a href='registro.html'>volver</a>";
            exit();
          }
};

  mysqli_select_db($conexion, "foro");

  //Prepara las consultas

  $consulta = "INSERT INTO usuarios (id, usuario, correo , contraseña)  VALUES ('', '$user', '$correo', '$password')";
  $repit = "SELECT * FROM usuarios";
  $user_post = "INSERT INTO usuarios (usuario) VALUES ($user)";

  //

  $consulta2 = mysqli_query($conexion, $repit);


  // Mediante el bucle while comprueba que en la base de datos no existan los datos
  // con los que se esta registrando el usuario

  while ($repetido = mysqli_fetch_array($consulta2)) {
    if ($repetido["usuario"] == $user) {
      echo "lo sentimos pero ese nombre ya esta en uso";
      exit();
    } elseif ($repetido["correo"] == $correo) {
      echo "lo sentimos pero ese correo ya esta en uso";
      exit();
    }
  }

  if (mysqli_query($conexion, $consulta)) {

    header("location: ../creada.html");

  } else {
  echo "error al almacenar usuario";
  }


} else {
  echo "error al conectarse a la base de datos";
}


 ?>
