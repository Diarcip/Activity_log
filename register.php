<?php
session_start();
ob_start();
include "Connection/connection.php";
$Yaexiste = 0;

if(isset($_POST['Registrar'])){

  $Nombre = $_POST['Nombre'];
  $Apellido = $_POST['Apellido'];
  $Email = $_POST['Email'];
  $Identificacion = $_POST['Identificacion'];
  $Sexo  = $_POST['Sexo'];
  $Rol = $_POST['Rol'];
  $Password1 = $_POST['Password1'];

  $QueryExistente = "SELECT * FROM USUARIO WHERE Identificacion='$Identificacion'";
  $ValidarExistente = mysqli_query($Connection,$QueryExistente);
  if(mysqli_num_rows($ValidarExistente)>0){
    $Yaexiste = 1;
    $OtroUsuario = '<!-- Alerta datos incorrectos -->
    <div class="text-center alert-dimi h6">
      <span class="badge badge-danger">
        <i class="fas fa-exclamation-triangle fas-xs"></i>
        El usuario ya existe
      </span>
    </div>';
  }else{

    $Query= "INSERT INTO USUARIO (Nombre,Apellido,Email,Identificacion,Sexo,Rol,Password1) values ('$Nombre', '$Apellido', '$Email', '$Identificacion', '$Sexo', '$Rol', '$Password1')";
    $REPLY= mysqli_query($Connection,$Query);

    if($REPLY){
      $_SESSION['Registrado'] = 1;
      mysqli_close($Connection);
      header("Location:login");
    }else{
      $OtroUsuario = '<!-- Alerta datos incorrectos -->
      <div class="text-center alert-dimi h6">
        <span class="badge badge-danger">
          <i class="fas fa-exclamation-triangle fas-xs"></i>
          Hubo un error al almacenar el usuario
        </span>
      </div>';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
      <?php include 'include/head.php'; ?>
      <title>Registro de usuarios</title>
  </head>
  <body class ="BGL-R">
    <div class="IconBack position-absolute">
        <a class="text-light" href="./.">
          <i class="mt-4 ml-4 fas fa-hand-point-left fa-3x "></i>
        </a>
    </div>


    <!-- Formulario Login -->
        <div class="SectionRegister">
            <!-- Card -->

            <div class="card bg-dark card-SectionRegister m-auto">

                <h5 class="card-header info-color white-text text-center py-4 mb-4">
                    <strong>Registrate</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                  <?php
                    if($Yaexiste == 1){
                      echo $OtroUsuario;
                    }
                  ?>

                  <!-- Form -->
                    <form class="formulario" action="register" method="POST" style="color: #757575;">

                        <!-- Nombre -->
                        <div class="md-form">
                            <i class="fas fa-smile-beam prefix fa-inverse"></i>
                            <input type="text" id="Nombre" name="Nombre" pattern="[A-Za-z]{3,}" class="form-control validate" required>
                            <label class="LabelForm" for="Nombre" data-error="Tu nombre sin acentos" data-success="">Nombre</label>
                        </div>

                        <!-- Apellido -->
                        <div class="md-form">
                            <i class="fas fa-grin-tongue-squint prefix fa-inverse"></i>
                            <input type="text" id="Apellido" name="Apellido" pattern="[A-Za-z]{3,}" class="form-control validate" required>
                            <label class="LabelForm" for="Apellido" data-error="Tu apellido sin acentos" data-success="">Apellido</label>
                        </div>

                        <!-- E-mail -->
                        <div class="md-form">
                            <i class="fas fa-envelope prefix fa-inverse"></i>
                            <input type="email" id="Email" name="Email" class="form-control validate" required>
                            <label class="LabelForm" for="Email" data-error="Revisa tu email" data-success="">E-mail</label>
                        </div>

                        <!-- Documento -->
                        <div class="md-form">
                            <i class="fa fa-user prefix prefix fa-inverse"></i>
                            <input type="text" id="Identificacion" name="Identificacion" pattern="[0-9]{7,}" class="form-control validate" required>
                            <label class="LabelForm" for="Identificacion" data-error="Mínimo 7 digitos (Cedula)" data-success="">Identificación</label>
                        </div>

                        <!-- Sexo -->
                        <div class="radio">
                          <i class="fas fa-transgender-alt prefix fa-inverse"></i>
                  				<input type="radio" name="Sexo" id="Masculino" value="Masculino" required>
                  				<label class="Primerradio" for="Masculino">Masculino</label>

                  				<input type="radio" name="Sexo" id="Femenino" value="Femenino">
                  				<label class="Otrosradio" for="Femenino">Femenino</label>
                  			</div>
                        <br>
                        <!-- Rol -->
                        <div class="radio">
                          <i class="fas fa-network-wired prefix fa-inverse iconrol"></i>
                  				<input type="radio" name="Rol" id="Empleado" value="Empleado" required>
                  				<label class="block" for="Empleado">Empleado</label>

                  				<input type="radio" name="Rol" id="Coordinador" value="Coordinador">
                  				<label class="block" for="Coordinador">Coordinador</label>

                          <input type="radio" name="Rol" id="Jefe" value="Jefe">
                  				<label class="block" for="Jefe">Jefe</label>
                  			</div>

                        <!-- Contraseña 1 -->
                        <div class="md-form">
                            <i class="fas fa-key prefix fa-inverse"></i>
                            <input type="password" id="Password1" name="Password1" pattern=".{6,}" class="form-control validate" required>
                            <label class="LabelForm" for="Password1" data-error="Mínimo 6 digitos" data-success="">Tu contraseña</label>
                        </div>

                        <!-- Contraseña 2 -->
                        <div class="md-form">
                            <i class="fa fa-lock prefix fa-inverse"></i>
                            <input type="password" id="Password2" name="Password2" pattern=".{6,}" class="form-control validate"required>
                            <label class="LabelForm" for="Password2" data-error="Revisa tu contraseña" data-success="">Repite tu contraseña</label>
                        </div>

                        <script src="js/ValidarContrasena.js"></script>

                        <!-- Send button -->
                        <button name="Registrar" class="btn btn-outline-primary btn-rounded btn-block z-depth-0 waves-effect mt-3" type="submit">Enviar</button>
                        <div class="text-center pt-3">
                            <a class="text-primary font-weight-light mb-2" href="login">Ya tengo una cuenta</a>
                        </div>

                    </form>

                  <!-- Form -->

                </div>

            </div>
            <!-- Material form contact -->
        </div>


    <!-- SCRIPTS -->
        <!-- JQuery -->
        <!-- SCRIPTS -->
        <!-- JQuery -->
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
  </body>
</html>
