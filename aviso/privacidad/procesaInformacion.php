<?php
require_once("../common/classCalendario.php");

$datosCalendario= new calendario();

#################################################################################

if(isset($_POST['task']) && $_POST['task']=='getCalendario'){
	#print_r($_POST);
	$json =$datosCalendario->getCalendario($_POST);
	die (json_encode($json));

}


?>