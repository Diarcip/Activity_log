<?php
session_start();
ob_start();
include "Connection/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Registro de actividades</title>
    <?php include 'include/head.php'; ?>
  </head>

  <body>

    <!-- Start your project here-->

        <!-- Navegacion -->
    <?php include 'include/nav.php'; ?>
        <!-- Header -->
    <header id="home-section" class="home-section">
      <div class="home-inner">
        <div class="container">
          <div class="row d-flex h-100">
            <div class="col-sm-6 text-center justify-content-center align-self-center">
              <h1>
                ¡Registra tus actividades laborales!
              </h1>
              <h5>Aplicación web donde podrás reportar las actividades laborales realizadas durante tu jornada laboral y poder exportar dichas actividades para realizar estadísticas.</h5>
              <br>
              <h5>Registra cada actividad por horas, visualiza y edita.</h5>
              <br>
              <a href="login" class="btn btn-outline-primary btn-lg text-white">
                ¡Empieza ya!
              </a>
            </div>
            <div class="col-sm-6">
              <img src="img/empleados.png" class="img-fluid d-none d-sm-block">
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="teamsection"class="bg-dark text-dark py-5">
      <div class="teamsection container p-5">
        <h1 class="text-center text-white">Developer team</h1>
        <p class="text-white">
          Equipo de trabajo en el proyecto correspondiente al registro de actividades laborales de la clase Refinamiento en Producción de Software.
        </p>
        <div class="row">
          <!-- USER TEAM -->
          <div class="col-lg-3">
            <div class="cardperson card">
              <div class="card-body">
                <img src="img/Male.png" class="d-block mx-auto imgDevelopers">
                <h3>Diego Cifuentes</h3>
                <p>
                  Estudiante de ingeniería de sistemas
                </p>
                <div class="d-block flex-row text-center">
                  <div class="pt-3">
                    <a href="#"><i class="fas fa-mail-bulk fa-2x"></i><br></a>
                  </div>
                  <div class="pt-3">
                    <a href="#">diego.cifuentes@cun.edu.co</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="cardperson card">
              <div class="card-body">
                <img src="img/Male.png" class="d-block mx-auto imgDevelopers">
                <h3>Nicolás Ardila</h3>
                <p>
                  Estudiante de ingeniería de sistemas
                </p>
                <div class="d-block flex-row text-center">
                  <div class="pt-3">
                    <a href="#"><i class="fas fa-mail-bulk fa-2x"></i><br></a>
                  </div>
                  <div class="pt-3">
                    <a href="#">nicolas.ardila@cun.edu.co</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="cardperson card">
              <div class="card-body">
                <img src="img/Female.png" class="d-block mx-auto imgDevelopers">
                <h3>Paula Jiménez</h3>
                <p>
                  Estudiante de ingeniería de sistemas
                </p>
                <div class="d-block flex-row text-center">
                  <div class="pt-3">
                    <a href="#"><i class="fas fa-mail-bulk fa-2x"></i><br></a>
                  </div>
                  <div class="pt-3">
                    <a href="#">paula.jimenezv@cun.edu.co</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="cardperson card">
              <div class="card-body">
                  <img src="img/Male.png" class="d-block mx-auto imgDevelopers">
                <h3>Sebastián Escobar</h3>
                <p>
                  Estudiante de ingeniería de sistemas
                </p>
                <div class="d-block flex-row text-center">
                  <div class="pt-3">
                    <a href="#"><i class="fas fa-mail-bulk fa-2x"></i><br></a>
                  </div>
                  <div class="pt-3">
                    <a href="#">sebastian.escobar@cun.edu.co</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- footer -->
    <?php include 'include/footer.php'; ?>
        <!-- /Start your project here-->
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
