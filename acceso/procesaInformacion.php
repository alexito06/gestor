<?php
require_once("../common/clsMiCNXAcceso.php");

$valAcceso= new acceso();

if(isset($_POST['task']) && $_POST['task']=='validaUsuario'){
//print_r($_POST);
	$json =$valAcceso->validaUsuarioDgire($_POST);

	if( $json->error == 0 ){
		session_start();
		unset($_SESSION['userInfo']);
		$_SESSION['userInfo'] = $json->usuDatos;
	}
	unset($json->usuDatos);
	die (json_encode($json));
}

?>