<?php
require_once "config.php"; 

	class DBCon{
		# MYSQL
	    protected $host; # Localhost o la ip 
	    protected $pass; # La contraseña del usr mysql 
	    protected $user; # el usr mysql

		# SELECCIONAR LA BASE EN QUE SE TRABAJA
	    protected $db_sistema;
		protected $db_pagos;

		# NUMERO DE CONEXIÓN
		protected $linkMysql;
		protected $linkSybase;
		protected $linkSybaseW;
		protected $linkSybaseZ;

		# HOSTS DE SYBASE
		protected $hostSybase;
		protected $hostSybaseW;
		protected $hostSybaseZ;
		
		# USUARIOS DE SYBASE
	    protected $userSybase;
	    protected $userSybaseZ;

		# PASSWORD DE SYBASE
		protected $passSybase;
		protected $passSybaseZ;

		# BASE DE DATOS DE SYBASE EN LA QUE SE TRABAJA
	    protected $dbSybase;
		protected $dbSybaseW;
		protected $dbSybaseZ;
		
		################################

		public function getLinkMysql(){
			return $this->linkMysql;
		}

		################################

		public function getLinkSybase(){
			return $this->linkSybase;
		}
		
		public function getLinkSybaseZ(){
			return $this->linkSybaseZ;
		}

		################################

		public function getLinkSybaseW(){
			return $this->linkSybaseW;
		}

		##### Parametros para la conexion a la base de datos #####

		public function __construct($hst = false, $pss = false, $usr = false, $dbn = false){
		global $CONFIG;

			$conf = $CONFIG['db_conn'];

			$this->host = $conf['host_sistema'];
			$this->user = $conf['us_sistema'];
			$this->password = $conf['pw_sistema'];
			$this->db_sistema =  $conf['db_sistema'];

			$this->db_pagos = $conf['db_pagos'];

			$this->hostSybaseW = $conf['host_SybaseW'];
			$this->userSybaseW = $conf['us_SybaseW'];
			$this->passSybaseW = $conf['pw_SybaseW'];
			$this->dbSybaseW = $conf['db_SybaseW'];

			$this->hostSybase = $conf['host_Sybase'];
			$this->userSybase = $conf['us_Sybase'];
			$this->passSybase = $conf['pw_Sybase'];
			$this->dbSybase = $conf['db_Sybase'];

			$this->hostSybaseZ = $conf['host_SybaseZ'];
			$this->userSybaseZ = $conf['us_SybaseZ'];
			$this->passSybaseZ = $conf['pw_SybaseZ'];
			$this->dbSybaseZ = $conf['db_SybaseZ'];

		}

		##### Conecciones de bases de datos #####

		public function conect($linkMysql = NULL, $linkSybase=NULL, $linkSybaseW = NULL){

			if($linkMysql == NULL){

				if(!$this->connectMysql()){
					$this->flagConect="mysql";
					return false;
				}
			}else{ $this->linkMysql = $linkMysql;	}

			/*if($linkSybaseW == NULL){

				if(!$this->connectSybaseW()){
				
					$this->flagConect="sybasew";
					return false;
				}
			}else{ $this->linkSybaseW = $linkSybaseW;	}

			if($linkSybase == NULL){
				if(!$this->connectSybase()){
					$this->flagConect="sybase";
					return false;
				}
			}else{	$this->linkSybase = $linkSybase;	}
			
			if($linkSybaseZ == NULL){
				if(!$this->connectSybaseZ()){
					$this->flagConect="sybase";
					return false;
				}
			}else{	$this->linkSybaseZ = $linkSybaseZ;	}*/

		return true;
		}
		
		public function errorConnect(){
			switch($this->flagConect){
				case "mysq":
					return mysql_error();
				break;
				case "sybase":
					return false;
				break;
				case "sybasew":
					return false;
				break;
			}
		}
		################################
		
		##### Transacciones de bases de datos #####	

		public function startTransactionMysql(){
			$query = "START TRANSACTION";
		return $this->executeQueryMysql($query);
		}

		public function commitMysql(){
			$query = "COMMIT";
		return $this->executeQueryMysql($query);
		}

		public function rollbackMysql(){
			$query = "ROLLBACK";
		return $this->executeQueryMysql($query);
		}

		################################

		private function connectMysql(){
		//echo $this->host.'-'.$this->user.'-'.$this->password.'-'.$this->db_sistema;
		$this->linkMysql = new MySQLi($this->host, $this->user, $this->password, $this->db_sistema);

			if(!$this->linkMysql){ 
				return false; 
			}

			if(!$this->linkMysql->set_charset('utf8')){
				return false;
			}

		return true;
		}

		################################

		private function closeMysql(){
			mysql_close($this->linkMysql);
		return true;
		}

		################################

		/*public function connectSybase(){
		#echo $this->hostSybase.','.$this->userSybase.','. $this->passSybase.','.$this->dbSybase;
			$this->linkSybase = @sybase_connect($this->hostSybase, $this->userSybase, $this->passSybase,'utf8');

			if(!$this->linkSybase){
				return false;
			}

			if(!@sybase_select_db($this->dbSybase, $this->linkSybase)){
				return false;	
			}

		return true;		
		}
		
		public function connectSybaseZ(){
		#echo $this->hostSybaseZ.','.$this->userSybaseZ.','. $this->passSybaseZ.','.$this->dbSybaseZ;
			$this->linkSybaseZ = @sybase_connect($this->hostSybaseZ, $this->userSybaseZ, $this->passSybaseZ,'utf8');

			if(!$this->linkSybaseZ){
				return false;
			}

			if(!@sybase_select_db($this->dbSybaseZ, $this->linkSybaseZ)){
				return false;	
			}

		return true;		
		}

		################################

		public function connectSybaseW(){
		#echo $this->hostSybaseW.','.$this->userSybaseW.','. $this->passSybaseW.','.$this->dbSybaseW;
			$this->linkSybaseW = @sybase_connect($this->hostSybaseW, $this->userSybase, $this->passSybase,'utf8');

			if(!$this->linkSybaseW){
				return false;
			}

			if(!@sybase_select_db($this->dbSybaseW, $this->linkSybaseW)){
				return false;	
			}

		return true;		
		}*/
		
		################################

		/*protected function executeQuerySybase($query){
			$this->db_last_qry = $query;
			$result = sybase_query($query, $this->linkSybase);

		return $result;
		}
		
		protected function executeQuerySybaseZ($query){
			$this->db_last_qry = $query;
			$result = sybase_query($query, $this->linkSybaseZ);

		return $result;
		}

		################################

		protected function executeQuerySybaseW($query){
			$this->db_last_qry = $query;
			$result = @sybase_query($query, $this->linkSybaseW);

		return $result;
		}*/

		################################

		public function executeQueryMysql($query){
			$this->db_last_qry = $query;
		return $result = $this->linkMysql->query($query);
		}
		
		public function getLastQuery(){

		return $this->db_last_qry;
		}

		################################

		public function switchMysqlDB($db){
			$query = "USE $db";
		return $this->executeQueryMysql($query);
		}

		################################

		public function getError(){
			return "Error #".$this->linkMysql->errno. ": ".$this->linkMysql->error. " query = ".$this->db_last_qry;
		}

		####################### OPERACIONES SOBRE TABLAS #####################################

		protected function genericUpdate($table_name, $update_fields, $where_conditions){

			$query = "UPDATE $table_name SET";
			# SET
			$sets = "";

			foreach($update_fields as $fName => $fCont){
				$sets .= ", $fName = ";
				$sets .= $fCont;
			}

			# CONDICIONES
			$where = "";
			foreach($where_conditions as $condition){
				$where .= "AND $condition ";
			}

			$query = $query . substr($sets, 1) . " WHERE " . substr($where, 4);

			$result = $this->executeQueryMysql($query);

		return $result;
		}

		################################

		protected function genericInsert($table_name, $def_fields, $cust_fields, $ret_index = false){
			$fields = "INSERT INTO $table_name (";
			
			$values = ') VALUES (';
			foreach($def_fields as $fName => $fCont){
				if(isset($cust_fields[$fName])){
					$fields .= $fName.", ";
						$values .= $cust_fields[$fName].", ";
					}else {
					if(!is_null($fCont)){
						$fields .= $fName.", ";
							$values .= $fCont.", ";
						}
					}
				}
			$query = substr($fields, 0, -2).substr($values, 0, -2).")";
			
			$result = $this->executeQueryMysql($query);
		
		return $result;
		}

		################################

		protected function genericDelete($table_name, $conditions){

			$query = "DELETE FROM $table_name ";

			# CONDICIONES
			$where = "";
			foreach($conditions as $condition){
				$where .= "AND $condition ";
			}

			$query = $query . " WHERE " . substr($where, 4);

			$result = $this->executeQueryMysql($query);

		return $result;
		}

		################################

		protected function createSelectMysql($rest,$value,$dato){

		$row="";

			$data= '<option value="" >-Seleccione-</option>';

			while($row = mysql_fetch_array($rest)){
				$data.= '<option value="'.$row[$value].'" >'.utf8_encode($row[$dato]).'</option>';
			}

		return $data;
		}

		public function createSelectMysqlGrid($rest,$value,$dato){

			while($row = mysql_fetch_array($rest)){
				$data .= ''.$row[$value].':'.addslashes($row[$dato]).';';
			}

			$data = substr($data, 0, -1);
		return $data;
		}

		################ PARAMETROS PRINCIPALES ################

		/*public function periodos(){

			$query = "select max(i_periodo) as max_periodo from unamsiw.dbo.inscripciones where i_periodo like '1%'";
			$result = $this->executeQuerySybaseW($query);
			$this->get_peridos = @sybase_fetch_object($result);
			$this->get_peridos->anio_periodo = (substr($this->get_peridos->max_periodo,0,2));

		}
		
		public function periodosPlantel(){

			//$query = "select max(pli_ciclo) as max_ciclo from unamsiw.dbo.planinco where pli_ciclo like '[1,2]%'";
			$query = "select max(p_anio) as max_ciclo from unamsiw.dbo.parametros_unamsi where p_anio not like '9%'";
			$result = $this->executeQuerySybaseW($query);
			$this->get_peridosPlantel = @sybase_fetch_object($result);
			$this->get_peridosPlantel->anio_periodoPlantel = $this->get_peridosPlantel->max_ciclo;

		}*/

		################################
}

?>
