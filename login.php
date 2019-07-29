<?php
  session_start();
  ob_start();
  include "Connection/connection.php";

  if(isset($_SESSION['Identificacion'])){
    header('Location: ./.');
  }
  $Mensaje = '';
  if(isset($_SESSION['Registrado'])){
    $Mensaje = '1';
    $Alerta = '<!-- Alerta datos incorrectos -->
    <div class="text-center alert-dimi h6">
      <span class="badge badge-success">
        <i class="fas fa-check-circle fas-xs"></i>
        Usuario creado
      </span>
    </div>';
    session_unset();
  	session_destroy();
  }
  if (!empty($_POST['USUARIO']) && !empty($_POST['Password1'])){

    $Identificacion = $_POST['USUARIO'];
    $Password1 = $_POST['Password1'];

    $consulta="select * from USUARIO where Identificacion = '$Identificacion' and Password1='$Password1'";
    $resultado= mysqli_query($Connection,$consulta);

    if(mysqli_num_rows($resultado)>0){
      $row = mysqli_fetch_array($resultado);
      $_SESSION['Identificacion'] = $row['Identificacion'];
      $_SESSION['Nombre'] = $row['Nombre'];
      $_SESSION['Apellido'] = $row['Apellido'];
      header("Location:./.");
    }else{
      $Mensaje = "1";
      $Alerta = '<!-- Alerta datos incorrectos -->
      <div class="text-center alert-dimi h6">
        <span class="badge badge-danger">
          <i class="fas fa-exclamation-triangle fas-xs"></i>
          Datos incorrectos
        </span>
      </div>';
    }
  }
?>
  <!DOCTYPE html>
  <html lang="es">
    <head>
        <?php include 'include/head.php'; ?>
        <title>Inicio de sesión</title>
    </head>
    <body class ="BGL-R">
    <div class="IconBack position-absolute">
        <a class="text-light" href="./.">
          <i class="mt-4 ml-4 fas fa-hand-point-left fa-3x"></i>
        </a>
    </div>


    <!-- Formulario Login -->
        <div class="SectionLogin">
            <!-- Card -->
            <div class="card bg-dark card-login m-auto">

              <h5 class="card-header info-color white-text text-center py-4 mb-4">
                  <strong>¡Inicia con tu cuenta!</strong>
              </h5>

                <!-- Card body -->
                <div class="card-body px-5">

                    <!-- Material form register -->
                    <form class="Login" action="login" method="POST">
                      <?php
                        if($Mensaje == 1){
                          echo $Alerta;
                        }
                      ?>

                        <!-- Material input text -->
                        <div class="md-form">
                            <i class="fa fa-user prefix fa-inverse"></i>
                            <input type="text" id="UserInput" name="USUARIO" pattern="[0-9]{7,}" class="form-control validate" required>
                            <label for="UserInput" data-error="Tu cédula" data-success="" class="font-weight-light">Tu identificación</label>
                        </div>

                        <!-- Material input password -->
                        <div class="md-form">
                            <i class="fa fa-lock prefix fa-inverse"></i>
                            <input type="password" id="PasswordInput" name="Password1" class="form-control validate" pattern=".{6,}" required>
                            <label for="PasswordInput" data-error="" data-success="" class="font-weight-light">Tu contraseña</label>
                        </div>

                        <div class="text-center pt-3">
                            <button name="Entrar" class="btn btn-outline-primary btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Entrar</button>
                        </div>
                        <div class="text-center pt-3">
                            <a class="text-primary font-weight-light" href="register">¿No tienes una cuenta aún?</a>
                        </div>

                    </form>
                    <!-- Material form register -->

                </div>
                <!-- Card body -->

            </div>
            <!-- Card -->
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
