<?php 

require_once("vistas/principal.php");
$ID_HOSPITALIZACION_UPDATE=$_GET["ID_HOSPITALIZACION_UPDATE"];

?>

<div class="container align-items-center ">
    <form class="container-fluid" method="POST" action="?view=EditGestion&ID_HOSPITALIZACION_UPDATE=<?php echo $ID_HOSPITALIZACION_UPDATE;?>">
        <h3 class="text-center text-sexondary">ACTUALIZAR GESTION HOSPITALARIA</h3>
     
        <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $users = $controlador->VerEditGestiones($_GET["ID_HOSPITALIZACION_UPDATE"]);
        foreach ($users as $user) {
        ?>
         <div class="mb-3">
            <label for="" class="form-label">ID HOSPITALIZACION *</label>
            <input type="text" class="form-control" name="ID_HOSPITALIZACION" value="<?php echo $user['ID_HOSPITALIZACION'];?>" readonly>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">TIPO DOCUMENTO *</label>
            <input type="text" class="form-control" name="TIPO_DOC_PACIENTE" value="<?php echo $user['TIPO_DOC_PACIENTE'];?>" readonly>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">DOCUMENTO *</label>
            <input type="text" class="form-control" name="NO_DOC_PACIENTE" value="<?php echo $user['NO_DOC_PACIENTE'];?>" readonly>
        </div>

        <div class="mb-3">
        <select class="form-select" aria-label="Default select example" name="COD_HOSPITAL_UPDATE" value="<?php echo $user['COD_HOSPITAL'];?>">
        <option value="<?php echo $user['COD_HOSPITAL'];?>"><?php echo $user['NOMBRE_HOSPITAL'];?></option>
        <?php 
        if(class_exists("Controlador")){
        $controlador = new Controlador();
        $users2 = $controlador->ListarHospitales();
        foreach ($users2 as $user2) {
        ?>
       <option value="<?php echo $user2['COD_HOSPITAL'];?>"><?php echo $user2['NOMBRE_HOSPITAL'];?></option>

        <?php
        }
    }
    ?> 
     </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">FECHA INGRESO *</label>
            <input type="datetime-local" class="form-control" name="FEC_INGRESO_UPDATE" value="<?php echo $user['FEC_INGRESO'];?>">
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">FECHA SALIDA</label>
            <input type="datetime-local" class="form-control" name="FEC_SALIDA_UPDATE" value="<?php echo $user['FEC_SALIDA'];?>">
        </div>

        <button type="submit" class="btn btn-primary" name="btnregistrar">Guardar</button> 
        
        <?php
        }
    }
    ?> 



        
    </form>
</div>

</section> 