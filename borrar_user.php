<?php
  session_start();
  if (empty($_SESSION["user"])) {
    header("location: inicio.html");
    exit();
  }elseif ($_SESSION["level"] != 1) {
      echo "acceso denegado";
      exit();
  }


  if($q=mysqli_connect("127.0.0.1", "root", "")) {
      mysqli_select_db($q, "foro");
      $consulta = "SELECT * FROM usuarios";
      $orden= mysqli_query($q, $consulta);
    };

 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/borrar_user1.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <title>Moderacion</title>
  </head>
  <body>
    <div class="grid-container">
      <div class="grid-item grid-header">
        <ul class="grid-header__ul">
          <li class="grid-header__li"><a href="#">Inicio</a></li>
          <li class="grid-header__li"><a href="lenguajes.php">Lenguaje</a></li>
          <li class="grid-header__li"><a href="perfil.php"><?php echo $_SESSION["user"]; ?></a></li>
          <li class="grid-header__li"><a href="configuracion/deslogueo.php">Cerrar Sesion</a></li>
        </ul>
      </div>
      <div class="grid-item grid-main">

        <div class="main-content">
          <?php
            while ($datos = mysqli_fetch_array($orden)) {
                $id = $datos["id"];
                ?>

                  <div class="main-content__caja1">
                  <p>Usuario: </p>
                  <p> <?php echo $datos["usuario"]; ?></p>
                  <p>Mail: </p>
                  <p> <?php echo $datos["correo"]; ?></p>
                  <p>Contraseña: </p>
                  <p> <?php echo $datos["contraseña"]; ?></p>
                  <br>
                  <!--Se generan dos formularios para enviar en un input hidden el id del usuario al que se desea modificar o eliminar los datos -->
                  <form class="main-content__caja1-form" action="configuracion/modif_admin.php" method="post">
                  <input type="hidden" name="id" value='<?php echo $id; ?>'>
                  <input type="submit" name="" value="modificar">
                  </form>
                  <form class="main-content__caja1-form" action="configuracion/delete_user.php" method="post">
                  <input type="hidden" name="id" value=<?php echo $id; ?>>
                  <input type="submit" name="" value="eliminar">
                  </form>
                  </div>
          <?php
            }




           ?>


            <div class="space-box"></div>

        </div>
      </div>
      <div class="grid-item grid-aside">
        <div class="aside__caja">


        </div>
      </div>

      <div class="grid-item grid-derecha">
        <div class="derecha__caja">

        </div>
      </div>
      <div class="grid-item grid-footer"></div>


    </div>
  </body>
</html>
