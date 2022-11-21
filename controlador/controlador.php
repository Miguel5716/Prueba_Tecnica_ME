<?php
class Controlador
{
    public function verPagina($url)
	{
		require_once($url);
	}

    public function ListarPacientes($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH)
	{
		$gestor = new Gestor();
		$result = $gestor->ListarPacientes($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH);
		return $result;
	}

	public function ListarGestiones($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH)
	{
		$gestor = new Gestor();
		$result = $gestor->ListarGestiones($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH);
		return $result;
	}

	public function ListarHospitales()
	{
		$gestor = new Gestor();
		$result = $gestor->ListarHospitales();
		return $result;
	}
	
	public function SearchPaciente($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH)
	{
		$gestor = new Gestor();
		$result = $gestor->SearchPaciente($TIPO_DOCUMENTO_SEARCH, $NO_DOCUMENTO_SEARCH);
		return $result;
	}

	public function VerEditPacientes($TIPO_DOCUMENTO_UPDATE, $NO_DOCUMENTO_UPDATE)
	{
		$gestor = new Gestor();
		$result = $gestor->VerEditPacientes($TIPO_DOCUMENTO_UPDATE, $NO_DOCUMENTO_UPDATE);
		return $result;
	}

    //Funcion del controlador que inserta el paciente
    public function InsertPaciente($TIPO_DOCUMENTO, $NO_DOCUMENTO, $NOMBRES ,$APELLIDOS ,$FEC_NACIMIENTO ,$EMAIL)
	{
		$gestor = new Gestor();
		$result = $gestor->InsertPaciente($TIPO_DOCUMENTO, $NO_DOCUMENTO, $NOMBRES ,$APELLIDOS ,$FEC_NACIMIENTO ,$EMAIL);
		switch ($result) {
			case '1':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Paciente registrado con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
			case '2':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al registrar paciente',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
			case '3':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Paciente existente',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
		}
	}

    public function EditPaciente($TIPO_DOCUMENTO_UPDATE, $NO_DOCUMENTO_UPDATE, $NOMBRES_UPDATE ,$APELLIDOS_UPDATE ,$FEC_NACIMIENTO_UPDATE ,$EMAIL_UPDATE)
	{
		$gestor = new Gestor();
		$result = $gestor->EditPaciente($TIPO_DOCUMENTO_UPDATE, $NO_DOCUMENTO_UPDATE, $NOMBRES_UPDATE ,$APELLIDOS_UPDATE ,$FEC_NACIMIENTO_UPDATE ,$EMAIL_UPDATE);
		switch ($result) {
			case '1':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Paciente actualizado con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;

			case '2':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al actualizar',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
		}
	}

    public function comfirmar_eliminar_pacientes()
	{
		require_once("vistas/PACIENTES/home.php");

		echo  "<script>
                Swal.fire({
                    title: 'Esta seguro de eliminar el paciente?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'No, Cancelar',
                    confirmButtonText: 'Si Eliminar!',
                    reverseButtons:true,
                    confirmButtonColor:'#dc3545'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?view=EliminarPaciente';
                        }else{
                            window.location.href = '?view=paciente';        
                        }    
                    })
				</script>";
	}

    public function EliminarPaciente($TIPO_DOCUMENTO_DELETE, $NO_DOCUMENTO_DELETE){
		$gestor = new Gestor();
		$result = $gestor->EliminarPaciente($TIPO_DOCUMENTO_DELETE, $NO_DOCUMENTO_DELETE);
		switch ($result) {
			case '1':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Paciente eliminado con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;

			case '2':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al eliminar',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			case '3':
				require_once("vistas/PACIENTES/home.php");
				echo  "<script>
							Swal.fire({
								position: 'warning',
								icon: 'error',
								title: 'Paciente registra gestiones hospitalarias',
								showConfirmButton: false,
								timer: 2500
							})
						</script>";
				break;
		}
	}

	public function InsertHospital($CODIGO, $NOMBRE_HOSPITAL)
	{
		$gestor = new Gestor();
		$result = $gestor->InsertHospital($CODIGO, $NOMBRE_HOSPITAL);
		switch ($result) {
			case '1':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Hospital registrado con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
			case '2':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al registrar hospital',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
			case '3':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Codigo hospital existente',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
		}
	}

	public function comfirmar_eliminar_hospitales()
	{
		require_once("vistas/HOSPITALES/home_hospital.php");

		echo  "<script>
                Swal.fire({
                    title: 'Esta seguro de eliminar el hospital?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'No, Cancelar',
                    confirmButtonText: 'Si Eliminar!',
                    reverseButtons:true,
                    confirmButtonColor:'#dc3545'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?view=EliminarHospitales';
                        }else{
                            window.location.href = '?view=hospitales';        
                        }    
                    })
				</script>";
	}

	public function EliminarHospitales($COD_HOSPITAL_DELETE){
		$gestor = new Gestor();
		$result = $gestor->EliminarHospitales($COD_HOSPITAL_DELETE);
		switch ($result) {
			case '1':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Hospital eliminado con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;

			case '2':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al eliminar',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			case '3':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Hospital registra gestiones hospitalarias',
								showConfirmButton: false,
								timer: 2500
							})
						</script>";
				break;
		}
	}

	public function VerEditHospitales($COD_HOSPITAL_UPDATE)
	{
		$gestor = new Gestor();
		$result = $gestor->VerEditHospitales($COD_HOSPITAL_UPDATE);
		return $result;
	}

	public function EditHospital($CODIGO_UPDATE, $NOMBRE_HOSPITAL_UPDATE)
	{
		$gestor = new Gestor();
		$result = $gestor->EditHospital($CODIGO_UPDATE, $NOMBRE_HOSPITAL_UPDATE);
		switch ($result) {
			case '1':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Hospital actualizado con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;

			case '2':
				require_once("vistas/HOSPITALES/home_hospital.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al actualizar',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
		}
	}

	public function InsertGestion($TIPO_DOC_PACIENTE, $NO_DOC_PACIENTE, $COD_HOSPITAL ,$FEC_INGRESO ,$FEC_SALIDA)
	{
		$gestor = new Gestor();
		$result = $gestor->InsertGestion($TIPO_DOC_PACIENTE, $NO_DOC_PACIENTE, $COD_HOSPITAL ,$FEC_INGRESO ,$FEC_SALIDA);
		switch ($result) {
			case '1':
				require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Gestion registrada con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
			case '2':
				require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al registrar gestion',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
			case '3':
				require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Gestion ya existe con las mismas fechas',
								showConfirmButton: false,
								timer: 2000
							})
						</script>";
				break;
		}
	}
	public function comfirmar_eliminar_gestion()
	{
		require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");

		echo  "<script>
                Swal.fire({
                    title: 'Esta seguro de eliminar el paciente?',
                    icon: 'question',
                    showCancelButton: true,
                    cancelButtonText: 'No, Cancelar',
                    confirmButtonText: 'Si Eliminar!',
                    reverseButtons:true,
                    confirmButtonColor:'#dc3545'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '?view=EliminarGestion';
                        }else{
                            window.location.href = '?view=GestionHospitalaria';        
                        }    
                    })
				</script>";
	}

	public function EliminarGestion($ID_HOSPITALIZACION_DELETE){
		$gestor = new Gestor();
		$result = $gestor->EliminarGestion($ID_HOSPITALIZACION_DELETE);
		switch ($result) {
			case '1':
				require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Gestion eliminada con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;

			case '2':
				require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al eliminar',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
		}
	}

	public function VerEditGestiones($ID_HOSPITALIZACION_UPDATE)
	{
		$gestor = new Gestor();
		$result = $gestor->VerEditGestiones($ID_HOSPITALIZACION_UPDATE);
		return $result;
	}

	public function EditGestion($ID_HOSPITALIZACION, $COD_HOSPITAL_UPDATE, $FEC_INGRESO_UPDATE ,$FEC_SALIDA_UPDATE)
	{
		$gestor = new Gestor();
		$result = $gestor->EditGestion($ID_HOSPITALIZACION, $COD_HOSPITAL_UPDATE, $FEC_INGRESO_UPDATE ,$FEC_SALIDA_UPDATE);
		switch ($result) {
			case '1':
				require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'success',
								title: 'Gestion actualizada con exito',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;

			case '2':
				require_once("vistas/GESTION_HOSPITALARIA/registrar_gestion.php");
				echo  "<script>
							Swal.fire({
								position: 'center',
								icon: 'error',
								title: 'Error al actualizar',
								showConfirmButton: false,
								timer: 1500
							})
						</script>";
				break;
			
		}
	}


}