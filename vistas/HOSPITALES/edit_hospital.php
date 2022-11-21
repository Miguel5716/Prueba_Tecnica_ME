<?php 

require_once("vistas/principal.php");
$COD_HOSPITAL_UPDATE=$_GET["COD_HOSPITAL_UPDATE"];

?>

<div class="container align-items-center ">
    <form class="container-fluid" method="POST" action="?view=EditHospital">
        <h3 class="text-center text-sexondary">ACTUALIZAR HOSPITALES</h3>
     
        <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $users = $controlador->VerEditHospitales($COD_HOSPITAL_UPDATE);
        foreach ($users as $user) {
        ?>
       
        <div class="mb-3">
            <label for="" class="form-label">CODIGO *</label>
                <input type="text" class="form-control" id="disabledTextInput" name="CODIGO_UPDATE" value="<?php echo $user['COD_HOSPITAL'];?>" readonly>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">NOMBRE HOSPITAL *</label>
            <input type="text" class="form-control" name="NOMBRE_HOSPITAL_UPDATE" value="<?php echo $user['NOMBRE_HOSPITAL'];?>" onkeyup="javascript:this.value = this.value.toUpperCase();" autocomplete="off">
        </div>

        <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar</button> 
        
        <?php
        }
    }
    ?> 



        
    </form>
</div>

</section> 