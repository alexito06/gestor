<?php
/*Este archivo almacena los parametros necesarios para la conexion y manejo de rutas*/

$CONFIG = array (

	'baseUrl' => $_SERVER['DOCUMENT_ROOT'],# Ruta url del proyecto

	'tempDir' => './dsis/jmeza/estadisticas/temp_upload',# Ruta de archivos temporales del sistema

	'baseDir' => './dsis/jmeza/estadisticas',# Ruta base del proyecto
	
	'bitRolStaff' => 42,# Bit que se checa

	# Arreglo de la conexion a las bases de datos
	'db_conn' => array(

		#'host_sistema' => "132.248.38.24:7408", # IP Base de Datos para el sistema
		#'us_sistema' => "admin_stati", # Usuario de mysql para el sistema
		#'pw_sistema' => "adminstati", # Password de mysql para el sistema
		#'db_sistema' => "dgire_estadisticas", # Base de Datos para el sistema
		
		'host_sistema' => "localhost", # IP Base de Datos para el sistema
		'us_sistema' => "root", # Usuario de mysql para el sistema
		'pw_sistema' => "", # Password de mysql para el sistema
		'db_sistema' => "reportes_gestor", # Base de Datos para el sistema
		
		
		
		'db_pagos' => "dgire_pagos2015", # Base de datos en al que vamos a trabajar la solicitud de pagos

		'host_SybaseW' => "132.248.38.4:4100", #IP Base de datos para Sybase
		'us_SybaseW' => "wwwuser", # Usuario de SybaseW
		'pw_SybaseW' => "Ewy4zi9m01", # Password de SybaseW
		'db_SybaseW' => "unamsiw", # Base de datos de SybaseW

		'host_Sybase' => "132.248.38.8:4101", # IP Base de datos para Sybase
		'us_Sybase' => "wwwuser", # Usuario de Sybase
		'pw_Sybase' => "Ewy4zi9m01", # Password de Sybase
		'db_Sybase' => "unamsi", # Base de datos de Sybase

		'host_SybaseZ' => "132.248.38.8:4101", # IP Base de datos para Sybase
		'us_SybaseZ' => "jmeza", # Usuario de Sybase
		'pw_SybaseZ' => "jamc010477", # Password de Sybase
		'db_SybaseZ' => "unamsi_admin", # Base de datos de Sybase

	),
	
	# Arreglo para envio de correo
	'mail' => array(

		'host' => "132.248.38.15;132.248.38.15", # Establece el servidor SMTP. Pueden ser varios separados por ;
		'From' => "jmca@correo.dgire.unam.mx", # Establece la dirección de correo de origen del Mensaje
		'FromName' => "Juan Manuel Carriles Arias", # Establece el nombre de quien envía el mensaje
		
		/*'Host' => "132.248.38.1;132.248.38.1", # Establece el servidor SMTP. Pueden ser varios separados por ;
		'From' => "jmca@dgire.unam.mx", # Establece la dirección de correo de origen del Mensaje
		'FromName' => "Juan Manuel Carriles Arias", # Establece el nombre de quien envía el mensaje*/
		
		'CharSet' => "utf-8", # Decodificación de correo
		
		'AddAddress' => 'jmeza@dgire.unam.mx', # Sintaxis www@dgire.unam.mmx, name. Añade una dirección de destino del mensaje. El parámetro name es opcional
		'AddCC' => "edgar@dgire.unam.mx, Edgar Muñoz", # Sintaxis www@dgire.unam.mmx, name. Manda una copia de tu email a otras personas que no son el destinatario principal y todo mundo puede ver quienes son.
		'AddBCC' => "bhinstudio@gmail.com, BhinStudio", # Sintaxis www@dgire.unam.mmx, name. "copia oculta" y manda una copia del email pero nadie puede ver quienes son esos destinatarios.

	),

	'recaptchaPublic' => "6LfWmQcTAAAAAHPXpYxfvcion1lS-S8yTUgpydO-", #servicios.dgire.unam.mx
	'recaptchaPrivate' => "6LfWmQcTAAAAAPAQqUQiYYHwWaGVGr3xLnDni4Ru",#servicios.dgire.unam.mx
);

?>