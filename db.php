<?php
class DataBase{

	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $db = DB_NAME;
	private $dbh;
	private $error;
	private $stmt;




	public function __construct(){

		//set DSN
		$dsn = 'pgsql:host='.$this->host.';dbname='.$this->db;

		//Set options
		$options = array(PDO::ATTR_PERSISTENT=> true, PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION);


		//New PDO instance
		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
				
		}
		//Error catch
		catch(PDOException $e) {
			$this ->error = $e->getMessage();
			echo $e->getMessage();
		}




	}


	public function query($query) {

		$this->stmt=$this->dbh -> prepare($query);

	}


	public function bind($param, $value, $type=NULL) {

		if(is_null($type)) {
			switch(true){
				case is_integer($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
						
				default:
					$type= PDO::PARAM_STR;
			}
		}

		$this->stmt->bindValue($param, $value, $type);

	}

	public function execute(){

		return $this->stmt->execute();

	}

	public function resultSet(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);

	}

	public function single(){
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_ASSOC);

	}

	public function rowCount() {
		return $this->stmt->rowCount();
	}

	public function LastInsertID() {
		return $this-> dbh-> lastInsertId();

	}




}