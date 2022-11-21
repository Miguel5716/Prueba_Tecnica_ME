<?php 
require_once("vistas/principal.php");
?>

<div class="container-fluid row">
<form class="col-4" method="POST" action="?view=InsertPaciente">
    <h3 class="text-center text-sexondary">REGISTRO DE PACIENTES</h3>
    <div class="mb-3">
        <label for="" class="form-label">TIPO DOCUMENTO *</label>
        <select class="form-select" aria-label="Default select example" name="TIPO_DOCUMENTO">
        <option selected>SELECCIONE TIPO DE DOCUMENTO</option>
        <option value="CC">CEDULA DE CIUDADANIA</option>
        <option value="TI">TARJETA DE IDENTIDAD</option>
        <option value="CE">CEDULA DE EXTRANJERIA</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="" class="form-label">DOCUMENTO *</label>
        <input type="text" class="form-control" name="NO_DOCUMENTO">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">NOMBRES *</label>
        <input type="text" class="form-control" name="NOMBRES" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">APELLIDOS *</label>
        <input type="text" class="form-control" name="APELLIDOS" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">FECHA NACIMIENTO *</label>
        <input type="date" class="form-control" name="FEC_NACIMIENTO">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">EMAIL </label>
        <input type="email" class="form-control" name="EMAIL" aria-describedby="emailHelp" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar</button>
</form>
<div class="col-8">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">PACIENTES REGISTRADOS</a>
  </div>
</nav>
<table class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">TIPO DOC</th>
            <th scope="col">DOCUMENTO</th>
            <th scope="col">NOMBRES</th>
            <th scope="col">APELLIDOS</th>
            <th scope="col">FEC NACIMIENTO</th>
            <th scope="col">EMAIL</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $tipo = '';
        $no = ''; 
        $users = $controlador->ListarPacientes($tipo, $no);
        foreach ($users as $user) {
        ?>
            <td><?php echo $user['TIPO_DOCUMENTO'];?></td>
            <td><?php echo $user['NO_DOCUMENTO'];?></td>
            <td><?php echo $user['NOMBRES'];?></td>
            <td><?php echo $user['APELLIDOS'];?></td>
            <td><?php echo $user['FEC_NACIMIENTO'];?></td>
            <td><?php echo $user['EMAIL'];?></td>
            <td>
                <a href="?view=edit_paciente&TIPO_DOCUMENTO_UPDATE=<?php echo $user['TIPO_DOCUMENTO'] ?>
                                    &NO_DOCUMENTO_UPDATE=<?php echo $user['NO_DOCUMENTO'] ?>" role="link" class="btn btn-small btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                <a href="?view=comfirmar_eliminar_pacientes&TIPO_DOCUMENTO_DELETE=<?php echo $user['TIPO_DOCUMENTO'] ?>
                                    &NO_DOCUMENTO_DELETE=<?php echo $user['NO_DOCUMENTO'] ?>" class="btn btn-small btn-danger"> 
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

