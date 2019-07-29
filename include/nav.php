<?php

  if(isset($_SESSION['Identificacion'])) {

      $UsuarioON = $_SESSION['Nombre']." ".$_SESSION['Apellido'];

?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
          <a class="navbar-brand" href="./.">Registro de actividades</a>
          <div class="UsuarioON">
            <p><span class="Conectado"><i class="fas fa-circle mr-1 fa-xs"></i></span>
            <?php echo $UsuarioON; ?>
            </p>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <div class="UsuarioONCollapse">
                <p><span class="Conectado"><i class="fas fa-circle mr-1 fa-xs"></i></span>
                <?php echo $UsuarioON; ?>
                </p>
              </div>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="./."><i class="fas fa-home mr-2"></i>Inicio</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="Nueva_actividad"><i class="fas fa-plus mr-2"></i>Registro</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="MisCosas"><i class="fas fa-user-circle mr-2"></i>Mis cosas</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="./Connection/Logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Salir</a>
              </li>
          </ul>
          </div>
      </div>
  </nav>
<?php
}else{ ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
          <a class="navbar-brand" href="./.">Registro de actividades</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
              <li class="nav-item">
              <a class="nav-link" href="./."><i class="fas fa-home mr-2"></i>Inicio</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="login"><i class="fas fa-plus mr-2"></i>Registro</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="MenuCuenta" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">Cuenta</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="MenuCuenta">
                  <a class="dropdown-item" href="login"><i class="fas fa-key mr-2"></i>Iniciar sesión</a>
                  <a class="dropdown-item" href="register"><i class="fab fa-wpforms mr-2"></i>Registrarse</a>
                </div>
              </li>
          </ul>
          </div>
      </div>
  </nav>
<?php
}
?>
