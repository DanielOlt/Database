<?php

class Database {


	/*
	*	Clase para el manejo de las operaciones con la base de datos.
	*
	*
	*/

	private $dbname;
	private $user;
	private $password;
	private $host;
	private $port;
	private $con;

	function Database($base,$usuario="usuario",$pass="password",$host="localhost",$puerto=3306){
		$this->dbname=$base;
		$this->user=$usuario;
		$this->password=$pass;
		$this->host=$host;
		$this->port=$puerto;

		$this->con = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port)
			or die ('Could not connect to the database server' . mysqli_connect_error());

	}

	function select($sql){

		$resultado=array();

		if(!$this->con->connect_errno){
			
			$resultset=$this->con->query($sql);			

			if($resultset){

			while ($fila=$resultset->fetch_assoc()) {
					$resultado[]=$fila;
			}
		}

		}else{

			echo "Error al ejecutar sentencias: " . $this->con->errno . " " . $this->con->error();
		}

		return $resultado;

	}

	function alter($sql){

	}

	function update($sql){
		if (!$this->con->connect_errno) {
			
			if ($this->con->query($sql)===TRUE) {
				return true;
			}
			else{
				return $this->con->error;
			}

		}
		else{
			return $this->con->connect_errno;
		}

	}

	function delete($sql){

	}
	function insert($sql){

		if(!$this->con->connect_errno){

			$this->con->query($sql);

			if ($this->con->affected_rows>0) {
				return true;
			}
			else
				return false;


		}else{
			echo "Error de conexión" . $this->con->errno;
		}

	}

	function cerrar(){

		$this->con->close();


	}
	function commit(){
		$this->con->commit();
	}
	function rollback(){
		$this->con->rollback();
	}

}


?>
