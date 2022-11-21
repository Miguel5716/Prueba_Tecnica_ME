<?php 
require_once("vistas/principal.php");
if( isset($result)) {
  echo $result;
}

if(isset($_POST["SeacrhPerson"]) ){
  $_SESSION["TIPO_DOCUMENTO_SEARCH"]=$_POST["TIPO_DOCUMENTO_SEARCH"];
  $_SESSION["NO_DOCUMENTO_SEARCH"]=$_POST["NO_DOCUMENTO_SEARCH"];
}
?>

<div class="container">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">BUSQUEDA PACIENTES REGISTRADOS</a>
    <form class="d-flex" method="POST" action="">
    <select class="form-select" aria-label="Default select example" name="TIPO_DOCUMENTO_SEARCH">
        <option selected>TIPO DE DOCUMENTO</option>
        <option value="CC">CEDULA DE CIUDADANIA</option>
        <option value="TI">TARJETA DE IDENTIDAD</option>
        <option value="CE">CEDULA DE EXTRANJERIA</option>
        </select>
        <h3>   |   </h3>
      <input class="form-control me-2" type="search" placeholder="N° DOCUMENTO" aria-label="Search"  name="NO_DOCUMENTO_SEARCH">
      <button class="btn btn-outline-success" type="submit" name='SeacrhPerson'>BUSCAR</button>
    </form>
  </div>
</nav>
  <div class="row">
    <div class="col">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">TIPO DOC</th>
                <th scope="col">DOCUMENTO</th>
                <th scope="col">NOMBRES</th>
                <th scope="col">APELLIDOS</th>
                <th scope="col">FEC NACIMIENTO</th>
                <th scope="col">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            if(class_exists("Controlador")){
            $controlador = new Controlador();
              $tipo = $_SESSION["TIPO_DOCUMENTO_SEARCH"];
              $no = $_SESSION["NO_DOCUMENTO_SEARCH"];         
              $users = $controlador->SearchPaciente($tipo, $no);    
            
            foreach ($users as $user) {
            ?>
                <td><?php echo $user['TIPO_DOCUMENTO'];?></td>
                <td><?php echo $user['NO_DOCUMENTO'];?></td>
                <td><?php echo $user['NOMBRES'];?></td>
                <td><?php echo $user['APELLIDOS'];?></td>
                <td><?php echo $user['FEC_NACIMIENTO'];?></td>
                <td>
                    <a href="?view=GestionHospitalaria&TIPO_DOCUMENTO=<?php echo $user['TIPO_DOCUMENTO'] ?>
                                        &NO_DOCUMENTO=<?php echo $user['NO_DOCUMENTO'] ?>" role="link" class="btn btn-small btn-primary"><i class="fa-regular fa-folder-open"></i></a>
                   
                </td>
            </tr> 
            
            <?php
            }
        }
        ?>   
        </tbody>
    </table>
    </div>
  </div>
</div>




</section>

