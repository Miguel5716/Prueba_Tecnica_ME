<?php 
require_once("vistas/principal.php");
?>


<div class="container-fluid row">
<form class="col-4" method="POST" action="?view=InsertHospital">
    <h3 class="text-center text-sexondary">REGISTRO DE HOSPITALES</h3>
    <div class="mb-3">
        <label for="" class="form-label">CODIGO *</label>
        <input type="text" class="form-control" name="CODIGO">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">NOMBRE HOSPITAL *</label>
        <input type="text" class="form-control" name="NOMBRE_HOSPITAL" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar</button>
</form>
<div class="col-8">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">HOSPITALES REGISTRADOS</a>
  </div>
</nav>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">CODIGO</th>
            <th scope="col">NOMBRE HOSPITAL</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $users = $controlador->ListarHospitales();
        foreach ($users as $user) {
        ?>
            <td><?php echo $user['COD_HOSPITAL'];?></td>
            <td><?php echo $user['NOMBRE_HOSPITAL'];?></td>
            <td>
                <a href="?view=edit_hospital&COD_HOSPITAL_UPDATE=<?php echo $user['COD_HOSPITAL'] ?>" role="link" class="btn btn-small btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="?view=comfirmar_eliminar_hospitales&COD_HOSPITAL_DELETE=<?php echo $user['COD_HOSPITAL'] ?>" class="btn btn-small btn-danger"> 
                <i class="fa-solid fa-trash"></i></a>
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



</section>

