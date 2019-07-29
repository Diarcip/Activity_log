<?php
session_start();
ob_start();
include "Connection/connection.php";

$Alerta = '';
if(isset($_SESSION['Identificacion'])){

  if(isset($_POST['NewActivity'])){
    date_default_timezone_set('America/Bogota');
    $Titulo = $_POST['Titulo'];
    $Titular = $_SESSION['Identificacion'];
    $ValueDepto = $_POST['Departamento'];
    $ConvertirDepto = "SELECT * FROM DEPARTAMENTO WHERE NOMBRE='$ValueDepto'";
    $QueryDepto = mysqli_query($Connection, $ConvertirDepto);
    if($QueryDepto){
      while ($RowDepto = mysqli_fetch_assoc($QueryDepto)){
          $Departamento = $RowDepto['ID_DEPTO'];
      }
    }
    $DateAlmacenado = date("Y-m-d H:i:s");
    $FechaActividad = $_POST['FechaActividad'];
    $HoraInicio = $_POST['Hora1'];
    $HoraFin = $_POST['Hora2'];
    $Descripcion = $_POST['Descripcion'];

    if(isset($Departamento)){

    $VerificarActividad = "SELECT * FROM ACTIVIDADES WHERE TITULO='$Titulo' AND TITULAR='$Titular' AND DEPARTAMENTO='$Departamento' AND FECHA_ACTIVIDAD='$FechaActividad' AND HORA_INICIO='$HoraInicio' AND HORA_FINAL='$HoraFin'";
    $QuerySelect = mysqli_query($Connection,$VerificarActividad);

    if(!mysqli_num_rows($QuerySelect)>0){
      $Query = "INSERT INTO ACTIVIDADES (TITULO,TITULAR,DEPARTAMENTO,FECHA_ACTIVIDAD,FECHA_REGISTRO,HORA_INICIO,HORA_FINAL,DESCRIPCION) VALUES
      ('$Titulo', '$Titular', '$Departamento', '$FechaActividad', '$DateAlmacenado', '$HoraInicio', '$HoraFin', '$Descripcion')";

      $Resultado = mysqli_query($Connection,$Query);

       if($Resultado){
         $_SESSION['ActividadAlmacenada'] = '<div class="alert alert-success" role="alert">
                                            <p>La actividad <strong>"'.$Titulo.'"</strong> fue guardada correctamente.</p>
                                            </div>';
         header("Location:./MisCosas");
       }else{
         $Alerta = '<div class="alert alert-danger" role="alert">
                    La actividad <strong>"'.$Titulo.'"</strong> no pudo ser guardada.
                    </div>';
       }
    }else{
      $Alerta = '<div class="alert alert-danger" role="alert">
                 La actividad <strong>"'.$Titulo.'"</strong> ya existe.
                 </div>';
    }
  }else{
    $Alerta ='<div class="alert alert-danger" role="alert">
               El valor ingresado en el campo "Departamento" no es válido, seleccione uno de la lista.
               </div>';
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <title>Nueva actividad</title>
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
          <div class="text-center justify-content-center align-self-center">
            <h1>
              ¡Ingresa una nueva actividad!
            </h1>
            <?php echo $Alerta; ?>
            <br>
            <!-- Extended material form grid -->
            <form id="formActividad" class="RegistrarActividad" method="POST" action="Nueva_actividad.php" onclick="HoraYFecha()">
              <!-- Grid row -->
              <div class="form-row">
                <!-- Titulo -->
                <div class="form-group col-md-12">
                  <label for="Titulo" class="h5"><i class="fab fa-font-awesome mr-2"></i>Título</label>
                  <input name="Titulo" type="text" class="form-control" id="Titulo" placeholder="Dale un nombre a tu actividad" required>
                </div>
              </div>
              <div class="form-row">
                <!-- Departamento -->
                <div class="form-group col-md-6">
                  <label for="Departamento" class="h5"><i class="fas fa-building mr-2"></i>Departamento/Área</label>
                  <input name="Departamento" list="Departamentos" class="form-control" id="Departamento" placeholder="Selecciona uno" required>
                  <datalist id="Departamentos">
                    <?php
                      $QueryDepartamentos = "SELECT * FROM DEPARTAMENTO ORDER BY NOMBRE";
                      $VerificarDepartamento = mysqli_query($Connection, $QueryDepartamentos);

                      if($VerificarDepartamento){
                          while ($Row = mysqli_fetch_assoc($VerificarDepartamento)){
                              echo '<option value="'.$Row['NOMBRE'].'">';
                          }
                      }
                    ?>
                  </datalist>
                </div>
                <!-- Fecha actividad -->
                <div class="form-group col-md-6">
                  <label for="Fecha" class="h5"><i class="fas fa-calendar-alt mr-2"></i>Fecha actividad</label>
                  <input name="FechaActividad" type="date" class="form-control" id="Fecha" required>
                </div>
              </div>
              <div class="form-row">
                <!-- Hora inicio -->
                <div class="form-group col-md-6">
                  <label for="Hora_inicio" class="h5"><i class="fas fa-clock mr-2"></i>Hora de inicio</label>
                  <input name="Hora1" type="time" class="form-control" id="Hora_inicio" required>
                </div>
                <!-- Hora fin -->
                <div class="form-group col-md-6">
                  <label for="Hora_fin" class="h5"><i class="fas fa-clock mr-2"></i>Hora de finalización</label>
                  <input name="Hora2" type="time" class="form-control" id="Hora_fin" required>
                </div>
              </div>
              <div class="form-row">
                <!-- Descripción -->
                <div class="form-group col-md-12">
                  <label for="Descripcion" class="h5"><i class="fas fa-file-alt mr-2"></i>Descripción</label>
                  <textarea name="Descripcion" class="form-control" id="Descripcion" name="Descripcion" rows="6" cols="120" placeholder="Describe de que se trata la actividad" required></textarea>
                </div>
              </div>
              <script src="js\HoraYFecha.js"></script>
              <!-- Botón -->
              <button name="NewActivity" class="btn btn-primary btn-rounded btn-block z-depth-0 waves-effect mt-3" type="submit">Enviar</button>
            </form>
            <!-- Extended default form grid -->
          </div>

        </div>
      </div>
    </div>
  </header>

  <!-- <section id="teamsection" class="bg-dark text-dark py-5">
      <div class="teamsection container p-5">
        <h1 class="text-center text-white">Developer team</h1>
        <p class="text-white">
          Equipo de trabajo en el proyecto correspondiente al registro de actividades laborales de la clase Refinamiento en Producción de Software.
        </p>
      </div>
    </section> -->

  <!-- footer -->
  <?php include 'include/footer.php'; ?>
  <!-- /Start your project here-->
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
<?php }else{
  header('Location: ./login');
} ?>
