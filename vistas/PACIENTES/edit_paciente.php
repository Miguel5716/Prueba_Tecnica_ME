<?php 

require_once("vistas/principal.php");
$TIPO_DOCUMENTO_UPDATE=$_GET["TIPO_DOCUMENTO_UPDATE"];
$NO_DOCUMENTO_UPDATE=$_GET["NO_DOCUMENTO_UPDATE"];

?>

<div class="container align-items-center ">
    <form class="container-fluid" method="POST" action="?view=EditPaciente">
        <h3 class="text-center text-sexondary">ACTUALIZAR PACIENTES</h3>
     
        <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $users = $controlador->VerEditPacientes($_GET["TIPO_DOCUMENTO_UPDATE"], $_GET["NO_DOCUMENTO_UPDATE"]);
        foreach ($users as $user) {
        ?>

        <div class="mb-3">
        <label for="" class="form-label">TIPO DOCUMENTO *</label>
       
            <select class="form-select" aria-label="Default select example" name="TIPO_DOCUMENTO_UPDATE" value="<?php echo $user['TIPO_DOCUMENTO'];?>">
                <option value="<?php echo $user['TIPO_DOCUMENTO'];?>" selected>
                <?php 
                if ($user['TIPO_DOCUMENTO'] == 'CC') {
                    echo 'CEDULA DE CIUDADANIA';
                } elseif ($user['TIPO_DOCUMENTO'] == 'TI') {
                    echo 'TARJETA DE IDENTIDAD';
                } elseif ($user['TIPO_DOCUMENTO'] == 'CE') {
                    echo 'CEDULA DE EXTRANJERIA';
                }
                ?></option>
                <option value="CC">CEDULA DE CIUDADANIA</option>
                <option value="TI">TARJETA DE IDENTIDAD</option>
                <option value="CE">CEDULA DE EXTRANJERIA</option>
            </select>
    
        </div>

        <div class="mb-3">
            <label for="" class="form-label">DOCUMENTO *</label>
            <input type="text" class="form-control" name="NO_DOCUMENTO_UPDATE" value="<?php echo $user['NO_DOCUMENTO'];?>" readonly>
        </div>
       
        <div class="mb-3">
            <label for="" class="form-label">NOMBRES *</label>
            <input type="text" class="form-control" name="NOMBRES_UPDATE" value="<?php echo $user['NOMBRES'];?>" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">APELLIDOS *</label>
            <input type="text" class="form-control" name="APELLIDOS_UPDATE" value="<?php echo $user['APELLIDOS'];?>" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">FECHA NACIMIENTO *</label>
            <input type="date" class="form-control" name="FEC_NACIMIENTO_UPDATE" value="<?php echo $user['FEC_NACIMIENTO'];?>">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">EMAIL </label>
            <input type="email" class="form-control" name="EMAIL_UPDATE" value="<?php echo $user['EMAIL'];?>" aria-describedby="emailHelp" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
        </div>

        <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar</button> 
        
        <?php
        }
    }
    ?> 



        
    </form>
</div>

</section> 