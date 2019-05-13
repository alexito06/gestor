<?php
require_once("../common/classGestor.php");

$datosGestor= new gestor();

#################################################################################

if(isset($_POST['task']) && $_POST['task']=='getCatalogo'){

	$json = $datosGestor->getCatalogo($_POST);
	die (json_encode($json));

}


if(isset($_POST['task']) && $_POST['task']=='getPersonas'){

	$json = $datosGestor->getPersonas($_POST);
	die (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getEnviardatos'){

	$json = $datosGestor->getEnviardatos($_POST);
	die (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getSolicitudes'){

	$json = $datosGestor->getSolicitudes($_POST);
	echo (json_encode($json));

}
//print_r($_POST);
if(isset($_POST['task']) && $_POST['task']=='getActEstado'){

	$json = $datosGestor->getActEstado($_POST);
	echo (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getArea'){

	$json = $datosGestor->getArea($_POST);
	echo (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getUsuario'){

	$json = $datosGestor->getUsuario($_POST);
	echo (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getGenerafolio'){

	$json = $datosGestor->getGenerafolio($_POST);
	echo (json_encode($json));

}

if(isset($_POST['task']) && $_POST['task']=='getObtenerfolio'){

	$json = $datosGestor->getObtenerfolio($_POST);
	echo (json_encode($json));

}

if(isset($_GET['task']) && $_GET['task']=='descarga'){

	$json =$datosGestor->descarga($_GET);

	switch ($json->valor->tipo_archivo){
		case "image":
			header("Content-Type: image/jpeg");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "image/jpeg":
			header("Content-Type: image/jpeg");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "image/gif":
			header("Content-Type: image/jpeg");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "image/png":
			header("Content-Type: image/jpeg");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "file":
			header("Content-type: application/msword");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "application/pdf":
			header("Content-type: application/pdf");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
			header("Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "application/vnd.ms-excel":
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;		
		case "application/vnd.ms-powerpoint":
			header("Content-type: application/vnd.ms-powerpoint");
			header("Content-Disposition: attachment; filename=".$json->valor->nombre_archivo);
			header("Content-Transfer-Encoding: binary");
		break;
		
		
	}

	echo $json->valor->contenido_archivo;

}
	if(isset($_POST['task']) && $_POST['task']=='eliminaArchivo'){

	$json = $datosGestor->eliminaArchivo($_POST);
	echo (json_encode($json));

}
	if(isset($_POST['task']) && $_POST['task']=='getConsulta'){

	$json = $datosGestor->getConsulta($_POST);
	echo (json_encode($json));

}

	if(isset($_POST['task']) && $_POST['task']=='getReporte'){

	$json = $datosGestor->getReporte($_POST);
	echo (json_encode($json));

}

	if(isset($_POST['task']) && $_POST['task']=='getEditaform'){

	$json = $datosGestor->getEditaform($_POST);
	echo (json_encode($json));

}

	if(isset($_POST['task']) && $_POST['task']=='getActualizaform'){

	$json = $datosGestor->getActualizaform($_POST);
	echo (json_encode($json));

	}

	if(isset($_POST['task']) && $_POST['task']=='getEliminaform'){

	$json = $datosGestor->getEliminaform($_POST);
	echo (json_encode($json));

	}

	if(isset($_POST['task']) && $_POST['task']=='getIdSolicitudform'){

	$json = $datosGestor->getIdSolicitudform($_POST);
	echo (json_encode($json));

	}

?>