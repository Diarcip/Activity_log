<?php
session_start();
ob_start();
include "./Connection/connection.php";
$Alerta = '';
if(isset($_SESSION['Identificacion'])){

  $TituloAlm = '';
  $DeptoAlm = '';
  $FechaActividadAlm = '';
  $HORA1Alm = '';
  $HORA2Alm = '';
  $DescripcionAlm = '';
  $Actividad = '';

  // LEER ACCION DE EDITAR Y EL VALOR ENVIADO POR GET

  if(isset($_GET['id_actividad'])){
    $Titular = $_SESSION['Identificacion'];
    $Actividad = $_GET['id_actividad'];
    $QueryActividades = "SELECT ACTIVIDADES.ID_ACTIVIDAD,ACTIVIDADES.TITULO,ACTIVIDADES.TITULAR,DEPARTAMENTO.NOMBRE,ACTIVIDADES.FECHA_ACTIVIDAD,ACTIVIDADES.HORA_INICIO,ACTIVIDADES.HORA_FINAL,ACTIVIDADES.DESCRIPCION FROM ACTIVIDADES,DEPARTAMENTO WHERE ACTIVIDADES.TITULAR='$Titular' AND ACTIVIDADES.ID_ACTIVIDAD='$Actividad' AND DEPARTAMENTO.ID_DEPTO=ACTIVIDADES.DEPARTAMENTO";
    $ConsultarActividades = mysqli_query($Connection,$QueryActividades);

    if($ConsultarActividades){
      while($Columna = mysqli_fetch_assoc($ConsultarActividades)){

        $TituloAlm = $Columna['TITULO'];
        $DeptoAlm = $Columna['NOMBRE'];
        $FechaActividadAlm = $Columna['FECHA_ACTIVIDAD'];
        $HORA1Alm = $Columna['HORA_INICIO'];
        $HORA2Alm = $Columna['HORA_FINAL'];
        $DescripcionAlm = $Columna['DESCRIPCION'];
      }

    }
  }

  // LEER NUEVOS DATOS Y ALMACENARLOS

  if(isset($_POST['EditActivity'])){
    date_default_timezone_set('America/Bogota');
    $ID_Actividad = $_POST['actividad'];
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
    $HoraInicio = $_POST['Hora1'];
    $HoraFin = $_POST['Hora2'];
    $Descripcion = $_POST['Descripcion'];

    if(isset($Departamento)){
      $Query = "UPDATE ACTIVIDADES SET
                TITULO='$Titulo',
                DEPARTAMENTO='$Departamento',
                HORA_INICIO='$HoraInicio',
                HORA_FINAL='$HoraFin',
                DESCRIPCION='$Descripcion'
                WHERE ID_ACTIVIDAD='$ID_Actividad'";
      $Resultado = mysqli_query($Connection,$Query);

       if($Resultado){
         $_SESSION['ActividadEditada'] = '<div class="alert alert-success" role="alert">
                                            <p>La actividad <strong>"'.$Titulo.'"</strong> fue actualizada correctamente.</p>
                                            </div>';
         header("Location:./MisCosas");
       }else{
         $Alerta = '<div class="alert alert-danger" role="alert">
                    La actividad <strong>"'.$Titulo.'"</strong> no pudo ser actualizada.
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
    <title>Editar actividad</title>
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
              <form id="formActividad" class="RegistrarActividad" method="POST" action="Editar.php" onclick="HoraYFecha()">
                <!-- Grid row -->
                <div class="form-row">
                  <!-- Titulo -->
                  <div class="form-group col-md-12">
                    <label for="Titulo" class="h5"><i class="fab fa-font-awesome mr-2"></i>Título</label>
                    <input name="Titulo" type="text" class="form-control" id="Titulo" placeholder="Dale un nombre a tu actividad" value="<?php echo $TituloAlm; ?>" required>
                  </div>
                </div>
                <div class="form-row">
                  <!-- Departamento -->
                  <div class="form-group col-md-6">
                    <label for="Departamento" class="h5"><i class="fas fa-building mr-2"></i>Departamento/Área</label>
                    <input type="list" name="Departamento" list="Departamentos" class="form-control" id="Departamento" placeholder="Selecciona uno" value="<?php echo $DeptoAlm; ?>" required>
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
                    <input name="FechaActividad" type="date" class="form-control" id="Fecha" value="<?php echo $FechaActividadAlm; ?>" disabled required>
                  </div>
                </div>
                <div class="form-row">
                <!-- Hora inicio -->
                  <div class="form-group col-md-6">
                    <label for="Hora_inicio" class="h5"><i class="fas fa-clock mr-2"></i>Hora de inicio</label>
                    <input name="Hora1" type="time" class="form-control" id="Hora_inicio" value="<?php echo $HORA1Alm; ?>" required>
                  </div>
                  <!-- Hora fin -->
                  <div class="form-group col-md-6">
                    <label for="Hora_fin" class="h5"><i class="fas fa-clock mr-2"></i>Hora de finalización</label>
                    <input name="Hora2" type="time" class="form-control" id="Hora_fin" value="<?php echo $HORA2Alm; ?>" required>
                  </div>
                </div>
                <div class="form-row">
                  <!-- Descripción -->
                    <div class="form-group col-md-12">
                      <label for="Descripcion" class="h5"><i class="fas fa-file-alt mr-2"></i>Descripción</label>
                      <textarea name="Descripcion" class="form-control" id="Descripcion" name="Descripcion" rows="6" cols="120" placeholder="Describe de que se trata la actividad" required><?php echo $DescripcionAlm; ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="actividad" value="<?php echo $Actividad ?>">
                <script src="js/HoraYFecha.js"></script>
                <!-- Botón -->
                <button name="EditActivity" class="btn btn-primary btn-rounded btn-block z-depth-0 waves-effect mt-3" type="submit">Actualizar</button>
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
