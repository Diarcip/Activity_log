<?php
session_start();
ob_start();
include "Connection/connection.php";

$Alerta = '';
if(isset($_SESSION['Identificacion'])){
  if(isset($_SESSION['ActividadAlmacenada'])){
    $Alerta = $_SESSION['ActividadAlmacenada'];
  }
  if(isset($_SESSION['ActividadEliminada'])){
    $Alerta = $_SESSION['ActividadEliminada'];
  }
  if(isset($_SESSION['ActividadEditada'])){
    $Alerta = $_SESSION['ActividadEditada'];
  }
  $Titular = $_SESSION['Identificacion'];
  $QueryActividades = "SELECT ACTIVIDADES.ID_ACTIVIDAD, ACTIVIDADES.TITULO, DEPARTAMENTO.NOMBRE, ACTIVIDADES.FECHA_REGISTRO, ACTIVIDADES.FECHA_ACTIVIDAD, ACTIVIDADES.HORA_INICIO, ACTIVIDADES.HORA_FINAL, ACTIVIDADES.DESCRIPCION FROM ACTIVIDADES, DEPARTAMENTO WHERE TITULAR='$Titular' AND ACTIVIDADES.DEPARTAMENTO=DEPARTAMENTO.ID_DEPTO ORDER BY FECHA_REGISTRO desc";
  $ConsutarActividades = mysqli_query($Connection,$QueryActividades);
?>

<!DOCTYPE html>
<html lang="es">

  <head>
    <title>Mis cosas</title>
    <?php include 'include/head.php'; ?>
  </head>

  <body>

    <!-- Start your project here-->

        <!-- Navegacion -->
    <?php include 'include/nav.php'; ?>
        <!-- Header -->
    <header id="home-section" class="home-section">
      <div class="home-inner">
        <div class="container container-table">
          <div class="text-center">
            <?php echo $Alerta;
            unset ($_SESSION['ActividadAlmacenada']);
            unset ($_SESSION['ActividadEliminada']);
            unset ($_SESSION['ActividadEditada']); ?>
            <h1>
              ¡Este es tu registro!
            </h1>
          </div>
          <div class="card card-contenido-tabla">
            <div class="card-header">
              <p class="d-inline-block NombreUsuario">
              <?php echo $UsuarioON; ?></p>
              <input type="button" class="btn btn-success exportar d-inline-block"onclick="tableToExcel('Registros', 'Registro de actividades')" value="Exportar">
            </div>
            <div class="card-body">

              <!-- datatable -->

              <table id="Registros" class="table table-light display nowrap registros" style="width:100%">
                <thead>
                  <tr class="bg-primary">
                    <th class="th-sm">Titulo
                    </th>
                    <th class="th-sm">Departamento
                    </th>
                    <th class="th-sm">Fecha
                    </th>
                    <th class="th-sm">Hora inicio
                    </th>
                    <th class="th-sm">Hora fin
                    </th>
                    <th class="th-sm">Descripción
                    </th>
                    <th class="th-sm">Acciones
                    </th>
                  </tr>
                </thead>
                <tfoot>
                  <tr class="bg-info">
                    <th class="th-sm">Titulo
                    </th>
                    <th class="th-sm">Departamento
                    </th>
                    <th class="th-sm">Fecha
                    </th>
                    <th class="th-sm">Hora inicio
                    </th>
                    <th class="th-sm">Hora fin
                    </th>
                    <th class="th-sm">Descripción
                    </th>
                    <th class="th-sm">Acciones
                    </th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                  while($RowActividad  = mysqli_fetch_assoc($ConsutarActividades)){
                    $ID_ACTIVIDAD = $RowActividad['ID_ACTIVIDAD'];
                    $Titulo = $RowActividad['TITULO'];
                    $Departamento = $RowActividad['NOMBRE'];
                    $Fecha = $RowActividad['FECHA_ACTIVIDAD'];
                    $Hora1 = $RowActividad['HORA_INICIO'];
                    $Hora2 = $RowActividad['HORA_FINAL'];
                    $Descripcion = $RowActividad['DESCRIPCION'];
                    $FechaRegistro = $RowActividad['FECHA_REGISTRO'];
                    date_default_timezone_set('America/Bogota');
                    $FechaAntes = new datetime($FechaRegistro);
                    $FechaHoy = new datetime();
                    $Intervalo = $FechaAntes->diff($FechaHoy);
                    $Vardia = $Intervalo->format('%d');
                    $Varmes = $Intervalo->format('%m');
                    $Varanio = $Intervalo->format('%Y');
                    $Cantidaddia = strval($Vardia);
                    $Cantidadmes = strval($Varmes);
                    $Cantidadanio = strval($Varanio);
                   ?>
                  <tr>
                    <td class="tdlargo"><?php echo $Titulo; ?></td>
                    <td class="tdlargo"><?php echo $Departamento; ?></td>
                    <td class="tdlargo"><?php echo $Fecha; ?></td>
                    <td class="tdlargo"><?php echo $Hora1; ?></td>
                    <td class="tdlargo"><?php echo $Hora2; ?></td>
                    <td class="tdlargo"><?php echo $Descripcion; ?></td>
                    <td class="text-center">

                    <?php if($Cantidaddia==0 && $Cantidadmes==0 && $Cantidadanio==0){ ?>
                      <!-- Botones activos -->
                      <a href="Editar.php?id_actividad=<?php echo $ID_ACTIVIDAD; ?>"><span class="fa-stack fa-xs">
                        <i class="fas fa-square fa-stack-2x" style="color:#3261b1;"></i>
                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                      </span></a>
                      <a href="include/Eliminar.php?id_actividad=<?php echo $ID_ACTIVIDAD; ?>"><span class="fa-stack fa-xs">
                        <i class="fas fa-square fa-stack-2x" style="color:tomato;"></i>
                        <i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
                      </span></a>

                    <?php }else{?>
                      <!-- Botones inactivos -->
                      <span class="fa-stack fa-xs">
                        <i class="fas fa-square fa-stack-2x" style="color:#666666;"></i>
                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                      </span></a>
                      <span class="fa-stack fa-xs">
                        <i class="fas fa-square fa-stack-2x" style="color:#666666;"></i>
                        <i class="fas fa-trash-alt fa-stack-1x fa-inverse"></i>
                      </span></a>
                    <?php } ?>

                    </td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>



            <script type="text/javascript">
              $(document).ready(function() {
                var table = $('#Registros').DataTable( {
                    responsive: true,
                    paging: false
                } );

                new $.fn.dataTable.FixedHeader( table );
              } );
            </script>

            </div>
          </div>
          <!-- /datatable -->
        </div>
      </div>
    </header>

    <section id="MisRegistros" class="bg-dark text-dark py-5">
      <div class="teamsection container p-5">
        <h1 class="text-center text-white">Mi registro de actividades</h1>

      </div>
    </section>

    <!-- footer -->
    <?php include 'include/footer.php'; ?>
        <!-- /Start your project here-->
        <!-- SCRIPTS -->
        <!-- JQuery -->
        <!-- Bootstrap tooltips -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <!-- Bootstrap core JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- Export Excel -->
        <script type="text/javascript" src="js/tableToExcel.js"></script>


  </body>
</html>
<?php }else{
  header('Location: ./login');
} ?>
