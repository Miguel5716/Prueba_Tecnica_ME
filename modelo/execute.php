<?php

require_once 'config/conexion.php';

class Gestor extends Conexion
{

    public function ListarPacientes($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH)
    {
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM pacientes WHERE TIPO_DOCUMENTO = :TIPO_DOCUMENTO AND NO_DOCUMENTO = :NO_DOCUMENTO";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":TIPO_DOCUMENTO", $TIPO_DOCUMENTO_SEARCH);
        $resultado->bindParam(":NO_DOCUMENTO", $NO_DOCUMENTO_SEARCH);
        $resultado->execute();
        $existe = $resultado->rowCount();
        if ($existe == 0) {
            $sql2 = "SELECT * FROM pacientes";
            $resultado2 = $conn->prepare($sql2);
            $resultado2->execute();
            $filas = $resultado2->fetchAll(PDO::FETCH_ASSOC);
            return $filas;    
        } else {
            $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $filas;
        }   
    }
    public function ListarGestiones($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH)
    {
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT gh.ID_HOSPITALIZACION, gh.TIPO_DOC_PACIENTE, gh.NO_DOC_PACIENTE, h.NOMBRE_HOSPITAL, gh.FEC_INGRESO, gh.FEC_SALIDA, gh.FEC_CREACION 
                FROM gestion_hospitalaria AS gh INNER JOIN hospitales AS h ON h.COD_HOSPITAL = gh.COD_HOSPITAL 
                WHERE TIPO_DOC_PACIENTE= :TIPO_DOC_PACIENTE AND NO_DOC_PACIENTE= :NO_DOC_PACIENTE ";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":TIPO_DOC_PACIENTE", $TIPO_DOCUMENTO_SEARCH);
        $resultado->bindParam(":NO_DOC_PACIENTE", $NO_DOCUMENTO_SEARCH);
        $resultado->execute();
        $existe = $resultado->rowCount();
        if ($existe == 0) {
            require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'info',
								title: 'Usuario no registra gestiones hospitalarias',
								showConfirmButton: false,
								timer: 2000
							})
						</script>";  
        } else {
            $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $filas;
        }   
    }

    public function SearchPaciente($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH)
    {
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM pacientes WHERE TIPO_DOCUMENTO = :TIPO_DOCUMENTO AND NO_DOCUMENTO = :NO_DOCUMENTO";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":TIPO_DOCUMENTO", $TIPO_DOCUMENTO_SEARCH);
        $resultado->bindParam(":NO_DOCUMENTO", $NO_DOCUMENTO_SEARCH);
        $resultado->execute();
        $existe = $resultado->rowCount();
        if ($existe == 0) {
            $sql2 = "SELECT * FROM pacientes";
            $resultado2 = $conn->prepare($sql2);
            $resultado2->execute();
            $filas = $resultado2->fetchAll(PDO::FETCH_ASSOC);
            $existe2 = $resultado2->rowCount();
            if ($existe == 0) {
                require_once("vistas/GESTION_HOSPITALARIA/home_gestion.php");
                    echo  "<script>
                                Swal.fire({
                                    position: 'center',
                                    icon: 'info',
                                    title: 'Usuario no encontrado',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            </script>";  
            }
            return $filas;    
        } else {
            $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);
            return $filas;
        }   
    }
    public function ListarHospitales()
    {
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM hospitales";
        $resultado = $conn->prepare($sql);
        $resultado->execute();
        $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $filas;
    }

    public function VerEditPacientes($TIPO_DOCUMENTO_UPDATE, $NO_DOCUMENTO_UPDATE)
    {
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM pacientes WHERE TIPO_DOCUMENTO = :TIPO_DOCUMENTO AND NO_DOCUMENTO = :NO_DOCUMENTO";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":TIPO_DOCUMENTO", $TIPO_DOCUMENTO_UPDATE);
        $resultado->bindParam(":NO_DOCUMENTO", $NO_DOCUMENTO_UPDATE);
        $resultado->execute();
        $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $filas;
    }

    public function InsertPaciente($TIPO_DOCUMENTO, $NO_DOCUMENTO, $NOMBRES ,$APELLIDOS ,$FEC_NACIMIENTO ,$EMAIL)
	{
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM pacientes WHERE TIPO_DOCUMENTO = :TIPO_DOCUMENTO AND NO_DOCUMENTO = :NO_DOCUMENTO";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":TIPO_DOCUMENTO", $TIPO_DOCUMENTO);
        $resultado->bindParam(":NO_DOCUMENTO", $NO_DOCUMENTO);
        $resultado->execute();
        $existe = $resultado->rowCount();
        if ($existe == 0) {

            $sql = "INSERT INTO pacientes (TIPO_DOCUMENTO, NO_DOCUMENTO, NOMBRES, APELLIDOS, FEC_NACIMIENTO, EMAIL) 
            VALUES(:TIPO_DOCUMENTO, :NO_DOCUMENTO, :NOMBRES, :APELLIDOS, :FEC_NACIMIENTO, :EMAIL)";
            $resultado = $conn->prepare($sql);
            $resultado->bindParam(":TIPO_DOCUMENTO", $TIPO_DOCUMENTO);
            $resultado->bindParam(":NO_DOCUMENTO", $NO_DOCUMENTO);
            $resultado->bindParam(":NOMBRES", $NOMBRES);
            $resultado->bindParam(":APELLIDOS", $APELLIDOS);
            $resultado->bindParam(":FEC_NACIMIENTO", $FEC_NACIMIENTO);
            $resultado->bindParam(":EMAIL", $EMAIL);
            $resultado->execute();
            $existe = $resultado->rowCount();
            if ($existe <> 0) {
                return 1; //paciente creado con exito
            } else {
                return 2; //error al crear paciente
            }
        } else {
            return 3; //ya existe el codigo del paciente
        }
        Conexion::cerrar_conexion($conn);
	}

    public function EditPaciente($TIPO_DOCUMENTO_UPDATE, $NO_DOCUMENTO_UPDATE, $NOMBRES_UPDATE ,$APELLIDOS_UPDATE ,$FEC_NACIMIENTO_UPDATE ,$EMAIL_UPDATE)
	{
            $conn = Conexion::abrir_conexion();
            $sql2 = "UPDATE pacientes SET TIPO_DOCUMENTO =:TIPO_DOCUMENTO_UPDATE, NO_DOCUMENTO =:NO_DOCUMENTO_UPDATE, NOMBRES =:NOMBRES_UPDATE, 
            APELLIDOS =:APELLIDOS_UPDATE, FEC_NACIMIENTO =:FEC_NACIMIENTO_UPDATE, EMAIL = :EMAIL_UPDATE 
            WHERE TIPO_DOCUMENTO = :TIPO_DOCUMENTO_WHERE AND NO_DOCUMENTO = :NO_DOCUMENTO_WHERE ";
            $resultado2 = $conn->prepare($sql2);
            $resultado2->bindValue(":TIPO_DOCUMENTO_UPDATE", $TIPO_DOCUMENTO_UPDATE);
            $resultado2->bindValue(":NO_DOCUMENTO_UPDATE", $NO_DOCUMENTO_UPDATE);
            $resultado2->bindValue(":NOMBRES_UPDATE", $NOMBRES_UPDATE);
            $resultado2->bindValue(":APELLIDOS_UPDATE", $APELLIDOS_UPDATE);
            $resultado2->bindValue(":FEC_NACIMIENTO_UPDATE", $FEC_NACIMIENTO_UPDATE);
            $resultado2->bindValue(":EMAIL_UPDATE", $EMAIL_UPDATE);
            $resultado2->bindValue(":TIPO_DOCUMENTO_WHERE", $TIPO_DOCUMENTO_UPDATE);
            $resultado2->bindValue(":NO_DOCUMENTO_WHERE", $NO_DOCUMENTO_UPDATE);
            $resultado2->execute();     
            $existe2 = $resultado2->rowCount();
            if ($existe2 <> 0) {
                return 1; //paciente actualizado con exito
            } else {
                return 2; //error al registrar paciente
            }
      
        Conexion::cerrar_conexion($conn);    
	}

    public function EliminarPaciente($TIPO_DOCUMENTO_DELETE, $NO_DOCUMENTO_DELETE)
	{
        $conn = Conexion::abrir_conexion();
        $sql1 = "SELECT * FROM gestion_hospitalaria WHERE TIPO_DOC_PACIENTE  = :TIPO_DOC_PACIENTE AND NO_DOC_PACIENTE = :NO_DOC_PACIENTE";
        $resultado1 = $conn->prepare($sql1);
        $resultado1->bindParam(":TIPO_DOC_PACIENTE", $TIPO_DOCUMENTO_DELETE);
        $resultado1->bindParam(":NO_DOC_PACIENTE", $NO_DOCUMENTO_DELETE);
        $resultado1->execute();
        $existe1 = $resultado1->rowCount();
        if ($existe1 == 0) {
            $conn = Conexion::abrir_conexion();
            $sql = "DELETE FROM pacientes WHERE TIPO_DOCUMENTO = :TIPO_DOCUMENTO_DELETE AND NO_DOCUMENTO = :NO_DOCUMENTO_DELETE";
            $resultado = $conn->prepare($sql);
            $resultado->bindParam(":TIPO_DOCUMENTO_DELETE", $TIPO_DOCUMENTO_DELETE);
            $resultado->bindParam(":NO_DOCUMENTO_DELETE", $NO_DOCUMENTO_DELETE);
            $resultado->execute();
            $existe = $resultado->rowCount();
            if ($existe <> 0) {
                return 1; //paciente eliminado con exito
            } else {
                return 2; //error al eliminar el paciente
            }
        } else {
            return 3; //ya existe cuenta con gestiones hospitalarias
        }
        Conexion::cerrar_conexion($conn);    
	}

    public function InsertHospital($CODIGO, $NOMBRE_HOSPITAL)
	{
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM hospitales WHERE COD_HOSPITAL  = :COD_HOSPITAL";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":COD_HOSPITAL", $CODIGO);
        $resultado->execute();
        $existe = $resultado->rowCount();
        if ($existe == 0) {

            $sql = "INSERT INTO hospitales (COD_HOSPITAL, NOMBRE_HOSPITAL) 
            VALUES(:COD_HOSPITAL, :NOMBRE_HOSPITAL)";
            $resultado = $conn->prepare($sql);
            $resultado->bindParam(":COD_HOSPITAL", $CODIGO);
            $resultado->bindParam(":NOMBRE_HOSPITAL", $NOMBRE_HOSPITAL);
            $resultado->execute();
            $existe = $resultado->rowCount();
            if ($existe <> 0) {
                return 1; //hospital creado con exito
            } else {
                return 2; //error al crear hospital
            }
        } else {
            return 3; //ya existe el codigo del hospital
        }
        Conexion::cerrar_conexion($conn);
	}

    public function EliminarHospitales($COD_HOSPITAL_DELETE)
	{
        $conn = Conexion::abrir_conexion();
        $sql1 = "SELECT * FROM gestion_hospitalaria WHERE COD_HOSPITAL  = :COD_HOSPITAL";
        $resultado1 = $conn->prepare($sql1);
        $resultado1->bindParam(":COD_HOSPITAL", $COD_HOSPITAL_DELETE);
        $resultado1->execute();
        $existe1 = $resultado1->rowCount();
        if ($existe1 == 0) {
            $conn = Conexion::abrir_conexion();
            $sql = "DELETE FROM hospitales WHERE COD_HOSPITAL = :COD_HOSPITAL";
            $resultado = $conn->prepare($sql);
            $resultado->bindParam(":COD_HOSPITAL", $COD_HOSPITAL_DELETE);
            $resultado->execute();
            $existe = $resultado->rowCount();
            if ($existe <> 0) {
                return 1; //hospital eliminado con exito
            } else {
                return 2; //error al eliminar el hospital
            }
        } else {
            return 3; //ya existe cuenta con gestiones hospitalarias
        }
        Conexion::cerrar_conexion($conn);    
	}

    public function VerEditHospitales($COD_HOSPITAL_UPDATE)
    {
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM hospitales WHERE COD_HOSPITAL = :COD_HOSPITAL";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":COD_HOSPITAL", $COD_HOSPITAL_UPDATE);
        $resultado->execute();
        $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $filas;
    }

    public function EditHospital($CODIGO_UPDATE, $NOMBRE_HOSPITAL_UPDATE)
	{
            $conn = Conexion::abrir_conexion();
            $sql2 = "UPDATE hospitales SET COD_HOSPITAL =:COD_HOSPITAL_UPDATE, NOMBRE_HOSPITAL =:NOMBRE_HOSPITAL_UPDATE 
            WHERE COD_HOSPITAL = :COD_HOSPITAL_WHERE ";
            $resultado2 = $conn->prepare($sql2);
            $resultado2->bindValue(":COD_HOSPITAL_UPDATE", $CODIGO_UPDATE);
            $resultado2->bindValue(":NOMBRE_HOSPITAL_UPDATE", $NOMBRE_HOSPITAL_UPDATE);
            $resultado2->bindValue(":COD_HOSPITAL_WHERE", $CODIGO_UPDATE);
            $resultado2->execute();     
            $existe2 = $resultado2->rowCount();
            if ($existe2 <> 0) {
                return 1; //paciente actualizado con exito
            } else {
                return 2; //error al registrar paciente
            }
      
        Conexion::cerrar_conexion($conn);    
	}

    
    public function InsertGestion($TIPO_DOC_PACIENTE, $NO_DOC_PACIENTE, $COD_HOSPITAL ,$FEC_INGRESO ,$FEC_SALIDA)
	{
        
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM gestion_hospitalaria WHERE FEC_INGRESO BETWEEN :FEC_INGRESO AND :FEC_SALIDA 
        AND FEC_SALIDA BETWEEN :FEC_INGRESO AND :FEC_SALIDA AND TIPO_DOC_PACIENTE = :TIPO_DOC_PACIENTE AND NO_DOC_PACIENTE = :NO_DOC_PACIENTE";
        $resultado = $conn->prepare($sql);
        $resultado->bindValue(":FEC_INGRESO", $FEC_INGRESO);
        $resultado->bindValue(":FEC_SALIDA", $FEC_SALIDA);
        $resultado->bindValue(":TIPO_DOC_PACIENTE", $TIPO_DOC_PACIENTE);
        $resultado->bindValue(":NO_DOC_PACIENTE", $NO_DOC_PACIENTE);
        $resultado->execute();
        $existe = $resultado->rowCount();
        if ($existe == 0) {
            date_default_timezone_set('America/Bogota');
            $FEC_CREACION = date('Y-m-d H:i:s');
            $sql2 = "INSERT INTO gestion_hospitalaria (TIPO_DOC_PACIENTE, NO_DOC_PACIENTE, COD_HOSPITAL, FEC_INGRESO, FEC_SALIDA, FEC_CREACION) 
            VALUES(:TIPO_DOC_PACIENTE, :NO_DOC_PACIENTE, :COD_HOSPITAL, :FEC_INGRESO, :FEC_SALIDA, :FEC_CREACION)";
            $resultado2 = $conn->prepare($sql2);
            $resultado2->bindParam(":TIPO_DOC_PACIENTE", $TIPO_DOC_PACIENTE);
            $resultado2->bindParam(":NO_DOC_PACIENTE", $NO_DOC_PACIENTE);
            $resultado2->bindParam(":COD_HOSPITAL", $COD_HOSPITAL);
            $resultado2->bindParam(":FEC_INGRESO", $FEC_INGRESO);
            $resultado2->bindParam(":FEC_SALIDA", $FEC_SALIDA);
            $resultado2->bindParam(":FEC_CREACION", $FEC_CREACION);
            $resultado2->execute();
            $existe2 = $resultado2->rowCount();
            if ($existe2 <> 0) {
                return 1; //gestion creado con exito
            } else {
                return 2; //error al crear gestion
            }
        } else {
            return 3; //ya existe gestion en las fechas seleccionadas 
        }
        Conexion::cerrar_conexion($conn);
	}

    public function EliminarGestion($ID_HOSPITALIZACION_DELETE)
	{
        $conn = Conexion::abrir_conexion();
        $sql = "DELETE FROM gestion_hospitalaria WHERE ID_HOSPITALIZACION  = :ID_HOSPITALIZACION ";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":ID_HOSPITALIZACION", $ID_HOSPITALIZACION_DELETE);
        $resultado->execute();
        $existe = $resultado->rowCount();
        if ($existe <> 0) {
            return 1; //gestion eliminado con exito
        } else {
            return 2; //error al eliminar la gestion
        }
        Conexion::cerrar_conexion($conn);    
	}

    public function VerEditGestiones($ID_HOSPITALIZACION_UPDATE)
    {
        $conn = Conexion::abrir_conexion();
        $sql = "SELECT * FROM gestion_hospitalaria AS gh INNER JOIN hospitales AS h ON h.COD_HOSPITAL = gh.COD_HOSPITAL  
        WHERE ID_HOSPITALIZACION = :ID_HOSPITALIZACION";
        $resultado = $conn->prepare($sql);
        $resultado->bindParam(":ID_HOSPITALIZACION", $ID_HOSPITALIZACION_UPDATE);
        $resultado->execute();
        $filas = $resultado->fetchAll(PDO::FETCH_ASSOC);
        return $filas;
    }

    public function EditGestion($ID_HOSPITALIZACION, $COD_HOSPITAL_UPDATE, $FEC_INGRESO_UPDATE ,$FEC_SALIDA_UPDATE)
	{
            $conn = Conexion::abrir_conexion();
            $sql2 = "UPDATE gestion_hospitalaria SET COD_HOSPITAL =:COD_HOSPITAL_UPDATE, FEC_INGRESO =:FEC_INGRESO_UPDATE, FEC_SALIDA =:FEC_SALIDA_UPDATE 
            WHERE ID_HOSPITALIZACION = :ID_HOSPITALIZACION ";
            $resultado2 = $conn->prepare($sql2);
            $resultado2->bindValue(":COD_HOSPITAL_UPDATE", $COD_HOSPITAL_UPDATE);
            $resultado2->bindValue(":FEC_INGRESO_UPDATE", $FEC_INGRESO_UPDATE);
            $resultado2->bindValue(":FEC_SALIDA_UPDATE", $FEC_SALIDA_UPDATE);
            $resultado2->bindValue(":ID_HOSPITALIZACION", $ID_HOSPITALIZACION);
            $resultado2->execute();     
            $existe2 = $resultado2->rowCount();
            if ($existe2 <> 0) {
                return 1; //gestion actualizada con exito
            } else {
                return 2; //error al registrar paciente
            }
      
        Conexion::cerrar_conexion($conn);    
	}

}
