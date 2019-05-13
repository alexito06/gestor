<?php
require_once("../common/classCalendario.php");

$datosCalendario= new calendario();

#################################################################################

if(isset($_POST['task']) && $_POST['task']=='getCalendario'){
	#print_r($_POST);
	$json =$datosCalendario->getCalendario($_POST);
	die (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getCalendarioAdmin'){
	#print_r($_POST);
	$json =$datosCalendario->getCalendarioAdmin($_POST);
	die (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='editActividad'){
	#print_r($_POST);
	$json =$datosCalendario->editCalendarioAdmin($_POST);
	die (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='editActividadForm'){
	#print_r($_POST);
	$json =$datosCalendario->editActividadForm($_POST);
	die (json_encode($json));

}


if(isset($_POST['task']) && $_POST['task']=='agregaFechaActividadNivelForm'){
	#print_r($_POST);
	$json =$datosCalendario->agregaFechaActividadNivelForm($_POST);
	die (json_encode($json));

}



?>