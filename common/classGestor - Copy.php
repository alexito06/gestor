 <?php
include_once ("clsConexion.php"); 
include_once ("config.php");



class gestor extends DBCon{

	public function __construct($linkMysql =NULL, $linkSybase =NULL, $linkSybaseW =NULL ){

		parent::__construct();

		$this->conect($linkMysql, $linkSybase, $linkSybaseW);

	}
###################################### MOSTRAR CATALOGO ##################################################
	public function getCatalogo($form){
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query = "SELECT DISTINCT staff_gpo,staff_sda  FROM `staff` where staff_gpo!='100' AND (staff_sda like 'SUBDIRECCION%' OR staff_sda like 'UNIDAD%' OR staff_sda like 'DIRECCION%') ORDER BY staff_sda";
		$result = $this->executeQueryMysql($query);

		if(!$result){
			return false;
		}
		
		$info='<option value="">Seleccione ...</option>';
		
		while ($obj = $result->fetch_object()){

			$info.='<optgroup label="'.$obj->staff_sda.'" class="">';
			
				$query1 = "SELECT DISTINCT staff_subgpo,staff_sda FROM staff where staff_gpo='".$obj->staff_gpo."' order by staff_sda";
				$result1 = $this->executeQueryMysql($query1);
				
				while ($obj1 = $result1->fetch_object()){
					$info.='<option value="'.$obj1->staff_subgpo.'">'.ucwords(strtolower($obj1->staff_sda)).'</option>';	
				}
		
			$info.='</optgroup>';

		}
	return (object)array("success"=>true, "getInfo"=>$info); 
	}

	public function getPersonas($form){
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		
		$info='<option value="">Seleccione ...</option>';
			
			$query1 = "SELECT staff_id,staff_nombre FROM staff where staff_subgpo='".$form['gpo']."' order by staff_nombre";
			$result1 = $this->executeQueryMysql($query1);
				
			while ($obj1 = $result1->fetch_object()){
				$info.='<option value="'.$obj1->staff_id.'">'.$obj1->staff_nombre.'</option>';	
			}

	return (object)array("success"=>true, "getPersona"=>$info); 
	}
	
########################################### ENVIAR FORMULARIO DE DATOS Y ARCHIVOS ##################################################
	public function getEnviardatos($form){
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);
	$folio = $this->getObtenerfolio($folio)->folio;

	//echo $_POST[$_SESSION['userInfo']->staff_login];
	//
	session_start();
	$login= $_SESSION['userInfo']->staff_login;
	//print_r($login);

				$query = "INSERT INTO consulta (area,usuario,login,modificacion,fc_reg,folio,publicacion,fc_ini,fc_fin,observaciones) VALUES ('".$_POST['departamentos']."','".$_POST['personas']."','".$login."','".$_POST['documento']."',NOW(),'".$folio."','".$_POST['mipublicacion']."','".$_POST['fc_ini']."','".$_POST['fc_fin']."','".$_POST['observaciones']."')";

				$result = $this->executeQueryMysql($query);

				if($result>0){	

					$query1 = "SELECT MAX(id) AS id FROM consulta";
					$result1 = $this->executeQueryMysql($query1);
					$obj1 = $result1->fetch_object();
					//$obj1->id;

					foreach($_FILES as $archivos){

					$temName = $archivos['tmp_name']; //Obtenemos el directorio temporal en donde se ha almacenado el archivo;
					$fileName = $archivos['name']; //Obtenemos el nombre del archivo
					$fileExtension = substr(strrchr($fileName, '.'), 1); //Obtenemos la extensión del archivo.

					//Comenzamos a extraer la informacion del archivo
					$fp = fopen($temName, "rb");//abrimos el archivo con permiso de lectura
					$contenido = fread($fp, filesize($temName));//leemos el contenido del archivo
					//Una vez leido el archivo se obtiene un string con caracteres especiales.
					$contenido = addslashes($contenido);//se escapan los caracteres especiales
					fclose($fp);//Cerramos el archivo

					$extencion = explode(".", $archivos['name']);

					$queryArchivo = "INSERT INTO `archivos` (`id_archivo`, `id`, `nombre_archivo`, `tipo_archivo`, `tamaño_archivo`, `contenido_archivo`, `extension_archivo`) VALUES (NULL, '".$obj1->id."', '".$archivos['name']."', '".$archivos['type']."', '".$archivos['size']."','".$contenido."' , '".$extencion[1]."')";

					$result2 = $this->executeQueryMysql($queryArchivo);
					
					}
				}
				
	return (object)array("success"=>true);

	}
###################################### MOSTRAR AREA ################################################
	public function getArea($area){
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query="SELECT staff_sda FROM staff WHERE staff_subgpo='".$area."'";
		$result = $this->executeQueryMysql($query);
		$obj = $result->fetch_object();

	//print $area;
	return (object)array("success"=>true, "nomArea"=>$obj->staff_sda);
	}
####################################### MOSTRAR USUARIO #######################################
	public function getUsuario($usuario){
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query="SELECT staff_nombre FROM staff WHERE staff_id='".$usuario."'";
		$result = $this->executeQueryMysql($query);
		$obj = $result->fetch_object();

	//print $area;
	return (object)array("success"=>true, "nomUsuario"=>$obj->staff_nombre);
	}
################################# ULTIMO ID COMO FOLIO #############################
	public function getGenerafolio($genera){
	global $CONFIG;
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query = "SELECT MAX(id) AS id FROM consulta";
		$result = $this->executeQueryMysql($query);
		$obj = $result->fetch_object();
		//$obj->id;

	return (object)array("success"=>true, "idUsuario"=>$obj->id);
	}
#################################################################################
	public function getObtenerfolio($id){
	global $CONFIG;
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$year = date('Y', time());
		$year1=date('y');
		$ultimo = ($this->getGenerafolio($obj->id)->idUsuario)+1;

		$query = "INSERT INTO folios (id, anio) VALUES ('".$ultimo."', '".$year."')";
		$result = $this->executeQueryMysql($query);

			if(!$result){
				return false;
			}

		$con = str_pad($ultimo, "3", "0", STR_PAD_LEFT);

		$folio = $year1.date('m', time()).date('d',time()).$con;
		//echo $folio;

		return (object)array("success"=>true, "folio"=>$folio);


}

######################################## MOSTRAR DATOS ADMIN ##################################
	public function getSolicitudes($form){

	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);


            $info='<thead class="bg-blue-gradient"><tr>
					<td align="center" width="20"><b> ID</b></td>
					<td align="center"><b> Area</b></td>
					<td align="center"><b> Usuario</b></td>
					<td align="center"><b> Modificacion</b></td>
					<td align="center"><b> Publicacion</b></td>
					<td align="center" width="120"><b>Fecha de Inicio</b></td>
					<td align="center" width="110"><b>Fecha de Fin</b></td>
					<td align="center"><b> Observaciones</b></td>
					<td align="center"><b> Archivos</b></td>
					<td aling="center"><b> Estado</b></td>
					<td aling="center"><b> Funciones</b></td>
                  </tr></thead>';
			
			$query ="SELECT * FROM consulta order by fc_ini";

			$result = $this->executeQueryMysql($query);
			
				$info.='<tbody>';

					while ($obj = $result->fetch_object()){ #while

						$this->getArea($obj->area);
						
						
						if($obj->publicacion==0){$u='No';}else{$u='Si';}
						if($obj->estado==0){$e='No Atendido' && $boton="show";}else{$e='Atendido' && $boton="hide";}

						$info.='<tr>';
						$info.='<td>'.$obj->id.'</td>';
						$info.='<td>'.$this->getArea($obj->area)->nomArea.'</td>';
						$info.='<td>'.$this->getUsuario($obj->usuario)->nomUsuario.'</td>';
						$info.='<td>'.$obj->modificacion.'</td>';
						$info.='<td>'.$u.'</td>';
						$info.='<td>'.$obj->fc_ini.'</td>';
						$info.='<td>'.$obj->fc_fin.'</td>';
						$info.='<td>'.$obj->observaciones.'</td>';
						$info.='<td>';
						
						

				$query1="SELECT * FROM archivos WHERE id=".$obj->id;
				$result1 = $this->executeQueryMysql($query1);



				 		$info.='<ul width="20%" class="mailbox-attachments clearfix">';
				 			while ($obj1 = $result1->fetch_object()){#while1

								switch($obj1->tipo_archivo){ 
							case "file":
							
								$info.='<li>
										  <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o text-blue"></i></span>
						
										  <div class="mailbox-attachment-info">
											<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-text-o"></i> '.$obj1->nombre_archivo.'</a>
												<span class="mailbox-attachment-size">
												  '.$obj1->tamaño_archivo.' KB
												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download bg-navy"></i></a>
												  <button class="btn btn-default btn-xs pull-right destroy"><i class="fa fa-eye-slash"></i></button>
												</span>
										  </div>
										</li>';
							
							break;
							#WORD
							case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
							
								$info.='<li>
								<div class="row">
											<div class="mailbox-attachment-info col-sm-10">
												<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-word-o text-blue"></i> '.$obj1->nombre_archivo.'</a>
												</div>
												<div class="mailbox-attachment-info col-sm-2">							  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>
												</div>
										  	</div>
										 </li>';
							
							break;
							#PDF
							case "application/pdf":
							
								$info.='<li>
										<div class="row">
											<div class="mailbox-attachment-info col-sm-10">
											<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-pdf-o text-red"></i> '.$obj1->nombre_archivo.'</a>
											</div>
											<div class="mailbox-attachment-info col-sm-2">												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>
											</div>
										  </div></li>';
							
							break;
							#EXCEL
							case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
							
								$info.='<li>
											<div class="row">
										  		<div class="mailbox-attachment-info col-sm-9">
												<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-excel-o text-green"></i> '.$obj1->nombre_archivo.'</a>
												</div>
												<div class="mailbox-attachment-info col-sm-3">												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>
												 </div>
										  </div>
										</li>';
							
							break;

							case "application/vnd.ms-excel":
							
								$info.='<li>
											<div class="row">
										  		<div class="mailbox-attachment-info col-sm-9">
												<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-excel-o text-green"></i> '.$obj1->nombre_archivo.'</a>
												</div>
												<div class="mailbox-attachment-info col-sm-3">												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>
												 </div>
										  </div>
										</li>';
							
							break;
							#POWER POINT
							case "application/vnd.ms-powerpoint":
							
							$info.='<li>
									  <div class="row">					
									  	<div class="mailbox-attachment-info col-sm-9">
										<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-powerpoint-o text-orange"></i> '.$obj1->nombre_archivo.'</a>
										</div>
										<div class="mailbox-attachment-info col-sm-3">											  
											  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>
										</div>
									  </div>
									</li>';
							
							break;
							#IMAGE			
							/*case "image":
							
								$base64 = base64_encode($obj1->contenido_archivo);
								$img = "<img src='data:image/jpg;base64,$base64' alt='".$obj1->nombre_archivo."'/>";
							
								$info.='<li>
										  <span class="mailbox-attachment-icon has-img">'.$img.'</span>
						
										  <div class="mailbox-attachment-info">
											<a href="#" class="mailbox-attachment-name"><i class="fa fa-image"></i> '.$obj1->nombre_archivo.'</a>
												<span class="mailbox-attachment-size">
												  '.$obj1->tamaño_archivo.' KB
												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>	
												   <button class="btn btn-default btn-xs pull-right destroy"><i class="fa fa-eye-slash"></i></button>									  
												</span>
										  </div>
										</li>';
							
							break;*/
							#JPEG
							case "image/jpeg":
							
								$base64 = base64_encode($obj1->contenido_archivo);
								$img = "<img src='data:image/jpg;base64,$base64' alt='".$obj1->nombre_archivo."'/>";
							
								$info.='<li>
										  <div class="row">
						
										  <div class="mailbox-attachment-info col-sm-10">
											<a href="#" class="mailbox-attachment-name"><i class="fa fa-image text-yellow"></i> '.$obj1->nombre_archivo.'</a>
												</div>
												<div class="mailbox-attachment-info col-sm-2">												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>	
												</div>
										  </div>
										</li>';
							
							break;
							#GIF
							case "image/gif":
							
								$base64 = base64_encode($obj1->contenido_archivo);
								$img = "<img src='data:image/jpg;base64,$base64' alt='".$obj1->nombre_archivo."'/>";
							
								$info.='<li>
										  <span class="mailbox-attachment-icon has-img">'.$img.'</span>
						
										  <div class="mailbox-attachment-info">
											<a href="#" class="mailbox-attachment-name"><i class="fa fa-image"></i> '.$obj1->nombre_archivo.'</a>
												<span class="mailbox-attachment-size">
												  '.$obj1->tamaño_archivo.' KB
												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>	
												   <button class="btn btn-default btn-xs pull-right destroy"><i class="fa fa-eye-slash"></i></button>									  
												</span>
										  </div>
										</li>';
							#PNG
							break;
							case "image/png":
							
								$base64 = base64_encode($obj1->contenido_archivo);
								$img = "<img src='data:image/jpg;base64,$base64' alt='".$obj1->nombre_archivo."'/>";
							
								$info.='<li>
										  <span class="mailbox-attachment-icon has-img">'.$img.'</span>
						
										  <div class="mailbox-attachment-info">
											<a href="#" class="mailbox-attachment-name"><i class="fa fa-image"></i> '.$obj1->nombre_archivo.'</a>
												<span class="mailbox-attachment-size">
												  '.$obj1->tamaño_archivo.' KB
												  
												  <a href="procesaInformacion.php?idFoto='.$obj1->id_archivo.'&task=descarga" class="btn btn-default btn-xs pull-right bg-navy"><i class="fa fa-cloud-download"></i></a>	
												   <button class="btn btn-default btn-xs pull-right destroy"><i class="fa fa-eye-slash"></i></button>									  
												</span>
										  </div>
										</li>';
							
							break;
						}

							}#fin de while 1

					$info.='</ul></td>';
					$info.='<td>';
					$info.='<div>';
						if($obj->estado==0){$e= 'No Atendido';}else{$e= 'Atendido';}
						if($obj->estado==0){				
							$info.='<label><input type="checkbox" class="status" id="'.$obj->id.'" name="status" value="'.$obj->id.'">'.$e.'</label>';
								}else{
							$info.='<label><input type="checkbox" class="status" id="'.$obj->id.'" name="status" value="'.$obj->id.'" checked>'.$e.'</label>';
						}

						$info.='</div>';
						$info.='</td>';
						$info.='<td>';
						$info.='<div><button type="submit" class="btn btn-default edit '.$boton.'" id="edit" value="'.$obj->id.'"><span class="glyphicon glyphicon-edit"></span> Editar</button>

						<button type="submit" class="btn btn-default delete '.$boton.'" id="delete" value="'.$obj->id.'"><span class="glyphicon glyphicon-erase"></span> Borrar</button></div>';
						$info.='</td>';
						$info.='</tr>';

					}#fin de while 
			
			$info.='</tbody>';

	return (object)array("success"=>true, "getSolicitudes"=>$info); 
	
	}

###################################### ACTUALIZA ESTADO #######################################
	public function getActEstado($form){
	global $CONFIG;
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query="UPDATE consulta SET";

		if($form['accion'] == 'Atendido'){
		$query.=" estado='1' ";
		}else if($form['accion'] == 'noAtendido'){
		$query.=" estado='0' ";
		}

		$query.="WHERE id=".$form['id'];

		$result = $this->executeQueryMysql($query);

	return (object)array("success"=>true);
	}
###################################### DESCARGA ARCHIVOS ##############################################
		public function descarga($form) {
		global $CONFIG;

		$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query = "SELECT * FROM archivos where id_archivo=".$form['idFoto'];
		$result = $this->executeQueryMysql($query);
		$obj = $result->fetch_object();
		

		return (object)array("valor"=>$obj); 
			
	}
######################################### MOSTRAR DATOS USUARIO ########################################
		public function getConsulta($form){
		global $CONFIG;		
		$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

				$info='<thead class="bg-blue-gradient"><tr>
					<td align="center" width="20" style="display:none"><b> ID</b></td>
					<td align="center"><b> Area</b></td>
					<td align="center"><b> Usuario</b></td>
					<td align="center"><b> Login</b></td>
					<td align="center"><b> Modificacion</b></td>
					<td align="center"><b> Fecha de Registro</b></td>
					<td align="center"><b> Publicacion</b></td>
					<td align="center" width="120"><b>Fecha de Inicio</b></td>
					<td align="center" width="110"><b>Fecha de Fin</b></td>
					<td align="center"><b> Observaciones</b></td>
					<td align="center" style="display:none"><b> Estado</b></td>
					<td align="center"><b> Obtener</b></td>
				</tr></thead>';
			
			$query ="SELECT * FROM consulta order by fc_ini";
			$result = $this->executeQueryMysql($query);
				$info.='<tbody>';

				while ($obj = $result->fetch_object()){#while

					$this->getArea($obj->area);
					if($obj->publicacion==0){$u='No';}else{$u='Si';}
					if($obj->estado==0){$e='No Atendido' && $color="danger";}else{$e='Atendido' && $color="success";}
	
					$info.='<tr class="'.$color.'">';
					$info.='<td style="display:none">'.$obj->id.'</td>';
					$info.='<td>'.$this->getArea($obj->area)->nomArea.'</td>';
					$info.='<td>'.$this->getUsuario($obj->usuario)->nomUsuario.'</td>';
					$info.='<td>'.$obj->login.'</td>';
					$info.='<td>'.$obj->modificacion.'</td>';
					$info.='<td>'.$obj->fc_reg.'</td>';
					$info.='<td>'.$u.'</td>';
					$info.='<td>'.$obj->fc_ini.'</td>';
					$info.='<td>'.$obj->fc_fin.'</td>';
					$info.='<td>'.$obj->observaciones.'</td>';
					$info.='<td style="display:none">'.$e.'</td>';
					$info.='<td style="background-color:#FDEDEC"><button type="submit" class="btn btn-danger pdfEnv" id="enviardatos" value="'.$obj->id.'"><span class="glyphicon glyphicon-download-alt"></span> PDF</button>
					</td>';
					$info.='</tr>';

				}#fin de while 
			$info.='</tbody>';

	return (object)array("success"=>true, "getConsulta"=>$info); 
	}
######################################## REPORTE PDF ################################################
	public function infSolicitud($form){
	global $CONFIG;

	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);


	$query ="SELECT * FROM consulta WHERE id=".$form['id'];
	$result = $this->executeQueryMysql($query);
	$obj = $result->fetch_object();

	return $obj;
	}
####################################### REPORTE FECHAS EXCEL #########################################
	public function getReporte($form) {
	global $CONFIG;

		$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query="SELECT * FROM consulta WHERE fc_reg BETWEEN '".$form['fecha1']."' AND '".$form['fecha2']."' ORDER BY fc_reg ASC" ;
		$result = $this->executeQueryMysql($query);


		$datos = array();

		while ($row = $result->fetch_array()){

			$area=$row['area'];
			$usuario=$row['usuario'];
			$login=$row['login'];
			$modificacion=$row['modificacion'];
			$fc_reg=$row['fc_reg'];
			$fc_ini=$row['fc_ini'];
			$fc_fin=$row['fc_fin'];
			$observaciones=$row['observaciones'];
			$estado=$row['estado'];

			$datos[]=array($area,$usuario,$login,$modificacion,$fc_reg,$fc_ini,$fc_fin,$observaciones,$estado);
			}

		return (object)array("datos"=>$datos); 

	}
######################################### ELIMINA ARCHIVO ###########################################
	public function eliminaArchivo($form){
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query="DELETE FROM archivos WHERE id_archivo=".$form['id'];

		$result = $this->executeQueryMysql($query);

	return (object)array("success"=>true);
	}
####################################### EDITA REGISTRO ##########################################
	public function getEditaform($form){
	#print_r($form);
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

			$query="SELECT id,area,usuario,modificacion,fc_reg,publicacion,fc_ini,fc_fin,observaciones FROM consulta WHERE id=".$form['id'];
			$result = $this->executeQueryMysql($query);
			$obj = $result->fetch_object();


			$info='<thead class=""><tr>
					<td align="center" width="20"><b> Archivos Existentes</b></td>
					<td align="center"><b> Nuevos Archivos </b></td>
					</tr></thead>';

			$info.='<body>';
			$query1="SELECT * FROM archivos WHERE id=".$obj->id;
			$result1 = $this->executeQueryMysql($query1);
			$i=1;
				while ($obj1 = $result1->fetch_object()){#while1

					$info.='<tr><td width="200">';

								switch($obj1->tipo_archivo){
									#WORD
									case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":

										$info.='
											<div class="row">
												<div class="mailbox-attachment-info col-sm-10">
													<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-word-o text-blue"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';

									break;
									#PDF
									case "application/pdf":

										$info.='
											<div class="row">
												<div class="mailbox-attachment-info col-sm-10">
												<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-pdf-o text-red"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';

									break;
									#EXCEL
									case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":

										$info.='
											<div class="row">
												<div class="col-sm-9">
													<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-excel-o text-green"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';

									break;

									case "application/vnd.ms-excel":

										$info.='
											<div class="row">
												<div class="col-sm-9">
													<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-excel-o text-green"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';

									break;
									#POWER POINT
									case "application/vnd.ms-powerpoint":

									$info.='
											<div class="row">
												<div class="col-sm-9">
													<a href="#" class="mailbox-attachment-name"><i class="fa fa-file-powerpoint-o text-orange"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';

									break;
									#JPEG
									case "image/jpeg":

										$info.='
											<div class="row">
												<div class=" col-sm-10">
													<a href="#" class="mailbox-attachment-name"><i class="fa fa-image text-yellow"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';

									break;
									#GIF
									case "image/gif":

										$info.='
											<div class="row">
												<div class="mailbox-attachment-info col-sm-10">
													<a href="#" class="mailbox-attachment-name"><i class="fa fa-image text-yellow"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';

									break;
									#PNG
									case "image/png":

									$info.='
											<div class="row">
												<div class="mailbox-attachment-info col-sm-10">
													<a href="#" class="mailbox-attachment-name"><i class="fa fa-image text-yellow"></i> '.$obj1->nombre_archivo.'</a>
												</div>
											</div>';
									
									break;
								}#Fin del switch

								$info.='</td>';

								$info.='<td>';
								$info.='<div class="col-md-9">
										<label for="exampleInputFile">Buscar Archivo '.$i.'</label>
										<input type="file" id="archivo'.$i.'/'.$obj1->id_archivo.'" name="archivo'.$i.'/'.$obj1->id_archivo.'">
									</div>';
								$info.='</td></tr>';

							$i++;
							}#fin de while

							for ($j = $i; $j <= 4; $j++) {
								$info.='<tr><td width="200"></td><td>';
								$info.='<div class="col-md-9">
											<label for="exampleInputFile">Buscar Archivo '.$j.'</label>
											<input type="file" id="archivo'.$i.'/" name="archivo'.$i.'/">
										</div>';
								$info.='</td></tr>';
							}

					$info.='</body>';

		return (object)array("success"=>true, "error"=>false, "datos"=>$obj,"id"=>$obj->id, "area"=>$this->getArea($obj->area)->nomArea, "usuario"=>$this->getUsuario($obj->usuario)->nomUsuario,"modificacion"=>$obj->modificacion,"publicacion"=>$obj->publicacion,"fc_ini"=>$obj->fc_ini,"fc_fin"=>$obj->fc_fin,"observaciones"=>$obj->observaciones, "files"=>$info,"info"=>$info);

	}

######################################## ACTUALIZA REGISTRO #####################################
public function getActualizaform($form){

	//print_r($form);
	global $CONFIG;		
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

	$query="UPDATE consulta SET ";
	
	if (isset($form['documento1'])) {
	$query .= "modificacion='".$form['documento1']."', ";
	}
	if (isset($form['mipublicacion1'])) {
	$query .= "publicacion='".$form['mipublicacion1']."', ";
	}
	if (isset($form['fc_ini1'])) {
	$query .= "fc_ini='".$form['fc_ini1']."', ";
	}
	if (isset($form['fc_fin1'])) {
	$query .= "fc_fin='".$form['fc_fin1']."', ";
	}
	if (isset($form['observaciones1'])) {
	$query .= "observaciones='".$form['observaciones1']."' ";
	}
	$query.="WHERE id=".$form['id'];
	//$result=$this->executeQueryMysql($query);

		foreach ($_FILES as $key => $valor) {

			$idUpdate = explode("/", $key);
			//echo '***'.$idUpdate[1].'***';
			if($idUpdate[1] != ''){
				
				//echo 'query de actualiza'.$idUpdate[1];
				foreach($_FILES as $archivos){
				$temName = $archivos['tmp_name']; //Obtenemos el directorio temporal en donde se ha almacenado el archivo;
				$fileName = $archivos['name']; //Obtenemos el nombre del archivo
				$fileExtension = substr(strrchr($fileName, '.'), 1); //Obtenemos la extensión del archivo.
				
				//Comenzamos a extraer la informacion del archivo
				$fp = fopen($temName, "rb");//abrimos el archivo con permiso de lectura
				$contenido = fread($fp, filesize($temName));//leemos el contenido del archivo
				//Una vez leido el archivo se obtiene un string con caracteres especiales.
				$contenido = addslashes($contenido);//se escapan los caracteres especiales
				fclose($fp);//Cerramos el archivo
				$extencion = explode(".", $archivos['name']);

				$queryArchivoa="UPDATE archivos SET ";

				if (isset($archivos['name'])) {
				$queryArchivoa .= "nombre_archivo='".$archivos['name']."', ";
				}
				if (isset($archivos['type'])) {
				$queryArchivoa .= "tipo_archivo='".$archivos['type']."', ";
				}
				if (isset($archivos['size'])) {
				$queryArchivoa .= "tamaño_archivo='".$archivos['size']."', ";
				}
				if (isset($contenido)) {
				$queryArchivoa .= "contenido_archivo='".$contenido."', ";
				}
				if (isset($extencion[1])) {
				$queryArchivoa .= "extension_archivo='".$extencion[1]."' ";
				}
				$queryArchivoa.="WHERE id_archivo=".$idUpdate[1]." and id=".$form['id'];

				//$result2 = $this->executeQueryMysql($queryArchivoa);

				}
			}else{//print_r($key);

				foreach($_FILES as $archivos){
				$temName = $archivos['tmp_name']; //Obtenemos el directorio temporal en donde se ha almacenado el archivo;
				$fileName = $archivos['name']; //Obtenemos el nombre del archivo
				$fileExtension = substr(strrchr($fileName, '.'), 1); //Obtenemos la extensión del archivo.
				
				//Comenzamos a extraer la informacion del archivo
				$fp = fopen($temName, "rb");//abrimos el archivo con permiso de lectura
				$contenido = fread($fp, filesize($temName));//leemos el contenido del archivo
				//Una vez leido el archivo se obtiene un string con caracteres especiales.
				$contenido = addslashes($contenido);//se escapan los caracteres especiales
				fclose($fp);//Cerramos el archivo
				$extencion = explode(".", $archivos['name']);
				
				$queryArchivoi = "INSERT INTO `archivos` (`id_archivo`, `id`, `nombre_archivo`, `tipo_archivo`, `tamaño_archivo`, `contenido_archivo`, `extension_archivo`) VALUES (NULL, '".$form['id']."', '".$archivos['name']."', '".$archivos['type']."', '".$archivos['size']."','".$contenido."' , '".$extencion[1]."')";

					//$result3 = $this->executeQueryMysql($queryArchivoi);
				}
			}
		}


	#############################################################################
	return (object)array("success"=>true);
	}
######################################## ELIMINA REGISTRO ###########################################
	public function getEliminaform($form){
	global $CONFIG;	
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$queryArchivos="DELETE FROM archivos WHERE id=".$form['id'];
		$result = $this->executeQueryMysql($queryArchivos);

		$queryConsulta="DELETE FROM consulta WHERE id=".$form['id'];
		$result1 = $this->executeQueryMysql($queryConsulta);

	return (object)array("success"=>true);
	}

#############################################################################################################




































##########################################################################################################################
	public function getEnviarArchivo($form){
	global $CONFIG;

	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);
	
	//print_r($form);
	
		foreach($_FILES as $archivos){

			move_uploaded_file($archivos['tmp_name'],
			"subidos/" . $archivos['name']);

		}
				
		$archivo = fopen("subidos/"."prueba.txt", "r");
	
		while(!feof($archivo)){
			$linea = fgets($archivo);
			$saltodelinea = nl2br($linea);

//echo $saltodelinea;

	 $periodo=substr($linea, 0, 3);
	 $examen =substr($linea, 3, 1);
	 $plantel=substr($linea, 4, 4);
	 $plan=substr($linea, 8, 2);
	 $anoplan=substr($linea, 10, 2);
	 $asignatura=substr($linea, 12, 4);
	 $grupo=substr($linea, 16, 4);
	 $expe_profesor=substr($linea, 20, 8);
	 $cupo=substr($linea, 28, 2);
	 $hora_ini=substr($linea, 30, 30);
	 $hora_fin=substr($linea, 60, 30);
	 
	$query = "INSERT INTO grupos (g_periodo,g_tipoexam,g_ptl,g_plan,g_aplan,g_asig,g_gpo,g_exp_prof,g_max_alum,horario,horario_final) VALUES ('".$periodo."','".$examen."','".$plantel."','".$plan."','".$anoplan."','".$asignatura."','".$grupo."','".$expe_profesor."','".$cupo."','".$hora_ini."','".$hora_fin."')";
				
	//$result = $ini->executeQueryMysql($query);

	
	}

		fclose($archivo);
				
	}
	
	public function getleerArchivo($form){
	global $CONFIG;
	
	//print_r($form);
	
	$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

				$info='<thead class="bg-blue-gradient"><tr>
					<td align="center" width="20" style="display:none"><b> ID</b></td>
					<td align="center"><b> Periodo</b></td>
					<td align="center"><b> Examen</b></td>
					<td align="center"><b> Plantel</b></td>
					<td align="center"><b> Plan o Carrera</b></td>
					<td align="center"><b> Año Plan</b></td>
					<td align="center"><b> Asignatura</b></td>
					<td align="center"><b>Grupo</b></td>
					<td align="center"><b>Expediente Profesor</b></td>
					<td align="center"><b> Cupo</b></td>
					<td align="center"><b> Hora Inicio</b></td>
					<td align="center"><b> Hora Fin</b></td>
				</tr></thead>';

				$info.='<tbody>';

				$archivo = fopen("subidos/"."prueba.txt", "r");

				while(!feof($archivo)){


					$linea = fgets($archivo);
					$saltodelinea = nl2br($linea);

					$periodo=substr($linea, 0, 3);
					$examen =substr($linea, 3, 1);
					$plantel=substr($linea, 4, 4);
					$plan=substr($linea, 8, 2);
					$anoplan=substr($linea, 10, 2);
					$asignatura=substr($linea, 12, 4);
					$grupo=substr($linea, 16, 4);
					$expe_profesor=substr($linea, 20, 8);
					$cupo=substr($linea, 28, 2);
					$hora_ini=substr($linea, 30, 30);
					$hora_fin=substr($linea, 60, 30);

					$info.='<tr>';
					$info.='<td>'.$periodo.'</td>';
					$info.='<td>'.$examen.'</td>';
					$info.='<td>'.$plantel.'</td>';
					$info.='<td>'.$plan.'</td>';
					$info.='<td>'.$anoplan.'</td>';
					$info.='<td>'.$asignatura.'</td>';
					$info.='<td>'.$grupo.'</td>';
					$info.='<td>'.$expe_profesor.'</td>';
					$info.='<td>'.$cupo.'</td>';
					$info.='<td>'.$hora_ini.'</td>';
					$info.='<td>'.$hora_fin.'</td>';
					$info.='</tr>';

				}#fin de while 
			$info.='</tbody>';

		fclose($archivo);
//echo $info;
	return (object)array("success"=>true, "getleerArchivo"=>$info); 
	}

}
?>
