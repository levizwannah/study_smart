<?php

require_once(__DIR__."/../interfaces/database.interface.php");

class DbManager implements DatabaseInterface{
    private $dbConnection = null;
    private $dbName;
    private $dbHost;
    private $rows;
    private $statements = [];
	private $withOptions = false;
	private $fetchAll = false;
	private $currentStatement;
	private $lastQuery;


    /**
     * @param bool $options - to pass to the PDO connection
     */
    public function __construct($options = false){
		$this->dbHost = "127.0.0.1"; 
        $this->dbPort = "3306";
        $this->dbName   = "study_smart_db";
        $this->withOptions = $options;
		//$this->currentStatement = null;
    }

	/**
	 * Connects to the database using the information in the .env folder.
	 *
	 * @return mixed
	 */
	public function connect() {
			$user = "root";
			$pass = "";
			$dsn = "mysql:host=$this->dbHost;port=$this->dbPort;dbname=$this->dbName";
			$options = [];

			if(!$this->withOptions){
				$options = [ 
					PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
					PDO::ATTR_EMULATE_PREPARES => false
			];
			}

			try {
				$this->dbConnection = new \PDO(
					$dsn,
					$user,
					$pass, 
					$options
				);
			} 
			catch (\PDOException $e) {
				echo $e->getMessage(). " Error occured while creating connection\n";
				exit($e->getMessage());
			}
	}
	
	/**
	 *
	 * @param string $table 
	 * @param array $columns 
	 * @param string $condition_string 
	 * @param array $condition_values  
	 * @param bool $add_ticks - 
	 * @return array|bool
	 */
	public function query($table, $columns, $condition_string, $condition_values, $add_ticks = true, $fetch_all = false) {
		$this->connect();

		if($add_ticks === true){
			$table = "`$table`";
		}

		$sql = "SELECT " . implode (", ", $columns) ." from $table where $condition_string";
		$this->setLastQuery($sql);

            $stmt = $this->dbConnection->prepare($sql);
            if($stmt->execute($condition_values)){
                $result = ($this->fetchAll || $fetch_all)? $stmt->fetchAll() : $stmt->fetch();
                $return = $result;
            }
            else{
                $return = false;
            }
			return $return;
	}
	
	
	/**
	 *
	 * @param string $table 
	 * @param array $columns 
	 * @param array $values 
	 *
	 * @return int
	 */
	public function insert($table, $columns, $values) {
		$sql = "INSERT INTO `$table`(". implode(", ",$columns). ") values (". $this->buildInsertPlaceholders(count($values)) .")";
		$this->setLastQuery($sql);

		$this->connect();
		$statement = $this->dbConnection->prepare($sql);
		$newRowId = -1;

		if($statement->execute($values)){
			$newRowId = $this->dbConnection->lastInsertId();
		}
		
		return $newRowId;
	}
	
	/**
	 *
	 * @param mixed $sql 
	 *
	 * @return mixed
	 */
	public function rawSql($sql) {
		
	}

	public function makeDatabase($sql){
		$this->connect();

		if($this->dbConnection->exec($sql)){
			return true;
		}
		return false;
	}
	
	/**
	 *
	 * @return mixed
	 */
	public function close() {
		$this->dbConnection = null;
	}

	/**
	 * @param int $number
	 * Creates the place holder string
	 */
	private function buildInsertPlaceholders($number){
		$placeholders = str_repeat("?,", $number);
		return substr($placeholders, 0, strlen($placeholders) - 1);
	}
	/**
	 * 
	 * @return bool
	 */
	public function getFetchAll() {
		return $this->fetchAll;
	}
	
	/**
	 * 
	 * @param bool $fetchAll 
	 * @return DbManager
	 */
	public function setFetchAll($fetchAll): self {
		$this->fetchAll = $fetchAll;
		return $this;
	}
	/**
	 *
	 * @param string $table 
	 * @param string $columns_string 
	 * @param array $values 
	 * @param string $condition_string 
	 * @param array $condition_values 
	 *
	 * @return bool
	 */
	public function update($table, $columns_string, $values, $condition_string, $condition_values) {
		$this->connect();

		$sql = "UPDATE `$table` set $columns_string where $condition_string";
		$this->setLastQuery($sql);

            $stmt = $this->dbConnection->prepare($sql);
			$this->currentStatement = $stmt;
			$combinedValues = array_merge($values, $condition_values);
            if($stmt->execute($combinedValues)){
                return true;
            }
			return false;
	}
	/**
	 *
	 * @param string $table 
	 * @param string $condition_string 
	 * @param array $condition_values 
	 *
	 * @return bool
	 */
	public function delete($table, $condition_string, $condition_values) {
		$this->connect();
		
		$sql = "DELETE from `$table` where $condition_string";
		$this->setLastQuery($sql);
		$stmt = $this->dbConnection->prepare($sql);
		$this->currentStatement = $stmt;
		if($stmt->execute($condition_values)){
			return true;
		}
		return false;
	}

	

	

    /**
     * Get the value of dbConnection
	 * @return \PDO
     */ 
    public function getDbConnection()
    {
		if(!$this->dbConnection){
			$this->connect();
		}
        return $this->dbConnection;
    }

    /**
     * Set the value of dbConnection
     *
     * @return  self
     */ 
    public function setDbConnection($dbConnection)
    {
        $this->dbConnection = $dbConnection;

        return $this;
    }

	/**
	 *
	 * @return mixed
	 */
	public function getAffRowsCount(){
		return $this->currentStatement->rowCount();
	}

	/**
	 * Get the value of lastQuery
	 */ 
	public function getLastQuery()
	{
		return $this->lastQuery;
	}

	/**
	 * Set the value of lastQuery
	 *
	 * @return  self
	 */ 
	public function setLastQuery($lastQuery)
	{
		$this->lastQuery = $lastQuery;

		return $this;
	}
}

?>