<?php
include_once ("clsConexion.php"); 
include_once ("config.php"); 

class acceso extends DBCon{
		
	public function __construct($linkMysql =NULL, $linkSybase =NULL, $linkSybaseW =NULL ){

		parent::__construct();

		$this->conect($linkMysql, $linkSybase, $linkSybaseW);
		
	}

	public function validaUsuarioDgire($form){
		global $CONFIG;
		$this->switchMysqlDB($CONFIG['db_conn']['db_sistema']);

		$query= "SELECT staff_nombre, staff_sda, staff_login, staff_pass, staff_atrib, 'Administrador' as nomRol, SUBSTRING(staff_atrib, ".$CONFIG['bitRolStaff'].", 1) AS rol from usuarios.e_staff where staff_login='".$form['txtLogin']."'";
		$result = $this->executeQueryMysql($query);
		//echo $result->num_rows;
		if(!$result){
			return false;
		}

		if ($result->num_rows == 0 ){
			return (object)array("error" => '1', "mensaje" => '<font color="#FF0000"><b>El usuario no es valido.</b></font>');
		}else{
			$obj = $result->fetch_object();
			return (object)array("error" => '0', "mensaje" =>  "El acceso es valido", "usuDatos" => $obj);
		}

		#$obj = $result->fetch_object();
		//print_r($obj);
		#return (object)array("error" => '0', "mensaje" =>  "El acceso es valido", "usuDatos" => $obj);

		/*$query= "select staff_nombre, staff_sda, staff_login, staff_pass, staff_atrib, nomRol='Administrador', SUBSTRING(staff_atrib, ".$CONFIG['bitRolStaff'].", 1) AS rol from estadisticas.dbo.e_staff where staff_login='".$form['txtLogin']."'";
		$result = $this->executeQuerySybase($query);

		if ($obj = @sybase_num_rows($result) == 0 ){
			return (object)array("error" => '1', "mensaje" => '<font color="#FF0000"><b>El usuario no es valido.</b></font>');
		}else{
			$obj = @sybase_fetch_object($result);
				if($obj->staff_login==$form['txtLogin']){
					if($obj->staff_pass==$form['txtPwd']){
						if($obj->rol != 0){
							return (object)array("error" => '0', "mensaje" =>  "El acceso es valido", "usuDatos" => $obj);
						}else{ return (object)array("error" => '1', "mensaje" =>  "El usuario no tiene permisos para esa aplicaci&oacute;n."); }
					}else{ return (object)array("error" => '1', "mensaje" =>  "El password no es valido"); }
				}else{ return (object)array("error" => '1', "mensaje" =>  "El login no es valido"); }
		}*/
	}
	

}

?>