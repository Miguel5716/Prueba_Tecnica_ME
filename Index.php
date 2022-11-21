<?php
session_start();
require_once("controlador/controlador.php");
require_once("modelo/execute.php");

$controlador = new Controlador();

if(isset($_GET["TIPO_DOCUMENTO_DELETE"]) && isset($_GET["NO_DOCUMENTO_DELETE"])){
    $_SESSION["TIPO_DOCUMENTO_DELETE"]=$_GET["TIPO_DOCUMENTO_DELETE"];
    $_SESSION["NO_DOCUMENTO_DELETE"]=$_GET["NO_DOCUMENTO_DELETE"];
}

if(isset($_GET["COD_HOSPITAL_DELETE"])){
    $_SESSION["COD_HOSPITAL_DELETE"]=$_GET["COD_HOSPITAL_DELETE"];
 
}

if(isset($_GET["ID_HOSPITALIZACION_DELETE"])){
    $_SESSION["ID_HOSPITALIZACION_DELETE"]=$_GET["ID_HOSPITALIZACION_DELETE"];
 
}

    if(isset($_GET["view"])) {
        switch ($_GET["view"]) {
            case 'home':
                require_once('vistas/HOME.php');
                break;
            case 'paciente':
                $controlador->verPagina('vistas/PACIENTES/home.php');
                break;   
            case 'hospitales':
                $controlador->verPagina("vistas/HOSPITALES/home_hospital.php");
                break; 
            case 'gestion_hospitalaria':
                $controlador->verPagina("vistas/GESTION_HOSPITALARIA/home_gestion.php");
                break; 

            case 'SearchPaciente':
                if( isset($_POST["TIPO_DOCUMENTO_SEARCH"]) && $_POST["TIPO_DOCUMENTO_SEARCH"] != "" && isset($_POST["NO_DOCUMENTO_SEARCH"]) && $_POST["NO_DOCUMENTO_SEARCH"] != "" ){
    
                    $result =$controlador->SearchPaciente( $_POST["TIPO_DOCUMENTO_SEARCH"], $_POST["NO_DOCUMENTO_SEARCH"] );
                    return $result;
    
                }else{
                    $controlador->verPagina("vistas/GESTION_HOSPITALARIA/home_gestion.php");
                    echo  "<script>
                                Swal.fire({
                                    position: 'center',
                                    icon: 'info',
                                    title: 'Ingrese tipo y numero de documento',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            </script>";
                }
                break;

            //Caso registrar paciente    
            case 'InsertPaciente':
                if( isset($_POST["TIPO_DOCUMENTO"])  && $_POST["TIPO_DOCUMENTO"] != "" && isset($_POST["NO_DOCUMENTO"])  && $_POST["NO_DOCUMENTO"] != "" ){
                    
                    $controlador->InsertPaciente($_POST["TIPO_DOCUMENTO"], $_POST["NO_DOCUMENTO"], $_POST["NOMBRES"], $_POST["APELLIDOS"], $_POST["FEC_NACIMIENTO"], $_POST["EMAIL"] );
    
                }else{
                    $controlador->verPagina("vistas/PACIENTES/home.php");
                    echo  "<script>
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'INGRESE LOS CAMPOS REQUERIDOS',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            </script>";
                }
                break;

            case 'EditPaciente':
                if( isset($_POST["TIPO_DOCUMENTO_UPDATE"]) && $_POST["TIPO_DOCUMENTO_UPDATE"] != "" && isset($_POST["NO_DOCUMENTO_UPDATE"]) && $_POST["NO_DOCUMENTO_UPDATE"] != "" ){
    
                    $controlador->EditPaciente( $_POST["TIPO_DOCUMENTO_UPDATE"], $_POST["NO_DOCUMENTO_UPDATE"], $_POST["NOMBRES_UPDATE"], $_POST["APELLIDOS_UPDATE"], $_POST["FEC_NACIMIENTO_UPDATE"], $_POST["EMAIL_UPDATE"] );
    
                }else{
                    $controlador->verPagina("vistas/PACIENTES/edit_paciente.php");
                    echo  "<script>
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'Datos no pueden ser vacio',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            </script>";
                }
                break;

            case 'edit_paciente':
                $controlador->verPagina("vistas/PACIENTES/edit_paciente.php");
                break;

            case 'comfirmar_eliminar_pacientes':
                $controlador->comfirmar_eliminar_pacientes();
                break;

            case 'EliminarPaciente':
                $controlador->EliminarPaciente($_SESSION["TIPO_DOCUMENTO_DELETE"], $_SESSION["NO_DOCUMENTO_DELETE"]);
                break;

            case 'InsertHospital':
                if( isset($_POST["CODIGO"])  && $_POST["CODIGO"] != "" && isset($_POST["NOMBRE_HOSPITAL"])  && $_POST["NOMBRE_HOSPITAL"] != "" ){
                    
                    $controlador->InsertHospital($_POST["CODIGO"], $_POST["NOMBRE_HOSPITAL"] );
    
                }else{
                    $controlador->verPagina("vistas/HOSPITALES/home_hospital.php");
                    echo  "<script>
                                Swal.fire({
                                    position: 'center',
                                    icon: 'warning',
                                    title: 'INGRESE LOS CAMPOS REQUERIDOS',
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            </script>";
                }
                break;

                case 'comfirmar_eliminar_hospitales':
                    $controlador->comfirmar_eliminar_hospitales();
                    break;

                case 'EliminarHospitales':
                    $controlador->EliminarHospitales($_SESSION["COD_HOSPITAL_DELETE"]);
                    break;

                case 'edit_hospital':
                    $controlador->verPagina("vistas/HOSPITALES/edit_hospital.php");
                    break;

                case 'EditHospital':
                    if( isset($_POST["CODIGO_UPDATE"])  && $_POST["CODIGO_UPDATE"] != "" && isset($_POST["NOMBRE_HOSPITAL_UPDATE"])  && $_POST["NOMBRE_HOSPITAL_UPDATE"] != "" ){
        
                        $controlador->EditHospital( $_POST["CODIGO_UPDATE"], $_POST["NOMBRE_HOSPITAL_UPDATE"] );
        
                    }else{
                        $controlador->verPagina("vistas/HOSPITALES/home_hospital.php");
                        echo  "<script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'warning',
                                        title: 'INGRESE LOS CAMPOS REQUERIDOS',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                </script>";
                    }
                    break;
                case 'GestionHospitalaria':
                    $controlador->verPagina("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
                    break;

                case 'InsertGestion':
                    if( isset($_POST["TIPO_DOC_PACIENTE"])  && $_POST["TIPO_DOC_PACIENTE"] != "" && isset($_POST["NO_DOC_PACIENTE"])  && $_POST["NO_DOC_PACIENTE"] != "" && isset($_POST["FEC_INGRESO"])  && $_POST["FEC_INGRESO"] != ""&& isset($_POST["COD_HOSPITAL"])  && $_POST["COD_HOSPITAL"] != "" ){
                        
                    $controlador->InsertGestion($_POST["TIPO_DOC_PACIENTE"], $_POST["NO_DOC_PACIENTE"], $_POST["COD_HOSPITAL"], $_POST["FEC_INGRESO"], $_POST["FEC_SALIDA"] );
        
                    }else{
                        $controlador->verPagina("vistas/GESTION_HOSPITALARIA/home_gestion.php");
                        echo  "<script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'warning',
                                        title: 'INGRESE LOS CAMPOS REQUERIDOS',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                </script>";
                    }
                    break;
                
                case 'comfirmar_eliminar_gestion':
                    $controlador->comfirmar_eliminar_gestion();
                    break;

                case 'EliminarGestion':
                    $controlador->EliminarGestion($_SESSION["ID_HOSPITALIZACION_DELETE"]);
                    break;
                case 'edit_gestion':
                    $controlador->verPagina("vistas/GESTION_HOSPITALARIA/edit_gestion.php");
                    break;

                case 'EditGestion':
                    if( isset($_POST["ID_HOSPITALIZACION"]) && $_POST["ID_HOSPITALIZACION"] != "" ){
        
                        $controlador->EditGestion( $_POST["ID_HOSPITALIZACION"], $_POST["COD_HOSPITAL_UPDATE"], $_POST["FEC_INGRESO_UPDATE"], $_POST["FEC_SALIDA_UPDATE"]);
        
                    }else{
                        $controlador->verPagina("vistas/GESTION_HOSPITALARIA/edit_gestion.php");
                        echo  "<script>
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'warning',
                                        title: 'Datos no pueden ser vacio',
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                </script>";
                    }
                    break;


        }     
    }else {
        require_once('vistas/HOME.php');
    }


    
    
    

?>