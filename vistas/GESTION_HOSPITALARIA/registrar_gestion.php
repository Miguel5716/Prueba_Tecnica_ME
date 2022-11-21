<?php 

require_once("vistas/principal.php"); 

if(isset($_GET["TIPO_DOCUMENTO"]) && isset($_GET["NO_DOCUMENTO"]) ){
$_SESSION["TIPO_DOCUMENTO"]=$_GET["TIPO_DOCUMENTO"];
$_SESSION["NO_DOCUMENTO"]=$_GET["NO_DOCUMENTO"];
}
?>

<div class="container-fluid row">
    <form class="col-4" method="POST" action="?view=InsertGestion">
        <h3 class="text-center text-sexondary">REGISTRO DE GESTION HOSPITALARIA</h3>

        <div class="mb-3">
            <label for="" class="form-label">TIPO DOCUMENTO *</label>
            <input type="text" class="form-control" name="TIPO_DOC_PACIENTE" value="<?php echo $_SESSION["TIPO_DOCUMENTO"];?>" readonly>
        </div>       
        <div class="mb-3">
            <label for="" class="form-label">DOCUMENTO *</label>
            <input type="text" class="form-control" name="NO_DOC_PACIENTE" value="<?php echo $_SESSION["NO_DOCUMENTO"];?>" readonly>
        </div> 
        <div class="mb-3">
        <select class="form-select" aria-label="Default select example" name="COD_HOSPITAL">
        <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $users = $controlador->ListarHospitales();
        foreach ($users as $user) {
        ?>
       <option value="<?php echo $user['COD_HOSPITAL'];?>"><?php echo $user['NOMBRE_HOSPITAL'];?></option>

        <?php
        }
    }
    ?> 
     </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">FECHA INGRESO *</label>
            <input type="datetime-local" class="form-control" name="FEC_INGRESO">
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">FECHA SALIDA</label>
            <input type="datetime-local" class="form-control" name="FEC_SALIDA">
        </div>

        <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar</button>        
       
    </form>
    <div class="col-8">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">GESTIONES HOSPITALARIAS DEL USUARIO <?php echo $_SESSION["TIPO_DOCUMENTO"];?>  - <?php echo $_SESSION["NO_DOCUMENTO"];?></a>
  </div>
</nav>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">TIPO DOC</th>
            <th scope="col">DOCUMENTO</th>
            <th scope="col">HOSPITAL</th>
            <th scope="col">FECHA INGRESO</th>
            <th scope="col">FECHA SALIDA</th>
            <th scope="col">FECHA REGISTRO</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $tipo = $_SESSION["TIPO_DOCUMENTO"];
        $no = $_SESSION["NO_DOCUMENTO"]; 
        $users = $controlador->ListarGestiones($tipo, $no);
        if(isset($users) ){
        foreach ($users as $user) {
        ?>
            <td><?php echo $user['TIPO_DOC_PACIENTE'];?></td>
            <td><?php echo $user['NO_DOC_PACIENTE'];?></td>
            <td><?php echo $user['NOMBRE_HOSPITAL'];?></td>
            <td><?php echo $user['FEC_INGRESO'];?></td>
            <td><?php echo $user['FEC_SALIDA'];?></td>
            <td><?php echo $user['FEC_CREACION'];?></td>
            <td>
                <a href="?view=edit_gestion&ID_HOSPITALIZACION_UPDATE=<?php echo $user['ID_HOSPITALIZACION'];?>" role="link" class="btn btn-small btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="?view=comfirmar_eliminar_gestion&ID_HOSPITALIZACION_DELETE=<?php echo $user['ID_HOSPITALIZACION'];?>" class="btn btn-small btn-danger"> 
                <i class="fa-solid fa-trash"></i></a>
            </td>
        </tr> 
        
        <?php
        }
    }
}
    ?>   
    </tbody>
</table>
</div>

</div>

</section> 