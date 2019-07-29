<?php
session_start();
ob_start();
include "../Connection/connection.php";

if(isset($_SESSION['Identificacion'])){
  if(isset($_GET['id_actividad'])){

    $Titular = $_SESSION['Identificacion'];
    $Actividad = $_GET['id_actividad'];
    $QueryActividades = "SELECT ID_ACTIVIDAD, TITULAR, TITULO FROM ACTIVIDADES WHERE TITULAR='$Titular' AND ID_ACTIVIDAD='$Actividad'";
    $ConsultarActividades = mysqli_query($Connection,$QueryActividades);
    if($ConsultarActividades){
      while($Columna = mysqli_fetch_assoc($ConsultarActividades)){
        $Tittle = $Columna['TITULO'];
      }
      $QueryBorrar = "DELETE FROM ACTIVIDADES WHERE ID_ACTIVIDAD = '$Actividad'";
      $Borrar = mysqli_query($Connection,$QueryBorrar);
      if($Borrar){
        $_SESSION['ActividadEliminada'] = '<div class="alert alert-success" role="alert">
                                           <p>La actividad <strong>"'.$Tittle.'"</strong> fue eliminada correctamente.</p>
                                           </div>';
        header("Location:../MisCosas");
      }else{
        $_SESSION['ActividadEliminada'] = '<div class="alert alert-danger" role="alert">
                   La actividad <strong>"'.$Tittle.'"</strong> no pudo ser eliminada.
                   </div>';
        header("Location:../MisCosas");
      }
    }else{
      $row = mysqli_fetch_array($QueryActividades);
      $Tittle = $row['TITULO'];
      $_SESSION['ActividadEliminada'] = '<div class="alert alert-danger" role="alert">
                 La actividad no pudo ser eliminada.
                 </div>';
      header("Location:../MisCosas");
    }
  }
}else{
  header("Location:../login.php");
}
?>
