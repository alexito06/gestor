<?php 
session_start();
require_once("config.php");
require_once("clsMiCNXAcceso.php");

$valAcceso= new acceso();

if(!isset($_SESSION['userInfo'])){
	header( "Location: ../index.php");
	exit;
}else{
	$path_script = substr($_SERVER['PHP_SELF'], strlen($CONFIG['baseDir']));
	$perms = $valAcceso->getPermissionList($_SESSION['userInfo']->idRol, $path_script);

	if(count($perms) == 0){
		header( "HTTP/1.1 401 Unauthorized");
		echo 'Permiso denegado';
		echo '<br />';
		echo $_SERVER['PHP_SELF'];
		exit;
	}

}
?>