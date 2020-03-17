<?php
class mysqlcls
{
	public $connection;
	protected $dbhost;	
	protected $dbuser;	
	protected $dbpassword;	
	protected $dbname;	
	function __construct()
	{
		$this->dbhost=MYSQL_DB_HOST;
		$this->dbuser=MYSQL_DB_USERNAME;
		$this->dbpassword=MYSQL_DB_PASSWORD;
		$this->dbname=MYSQL_DB_NAME;
	}
	public function connect()
	{
		if(is_null($this->dbhost))
		die("MySQL hostname not set");
		if(is_null($this->dbname))
		die("MySQL database not selected");
		$this->connection=@mysqli_connect($this->dbhost,$this->dbuser,$this->dbpassword);
		if($this->connection==false)
		die("Could not connect to database. Check your username and password then try again.\n");
		if(!mysqli_select_db($this->connection,$this->dbname))
		die("Could not select database");
	}
	public function close()
	{
		if($this->connection)
		{
			mysqli_close($this->connection);
			$this->connection=null;
		}
	}
	public function affectedRows() 
	{
		return mysqli_affected_rows($this->connection);
	}
	public function insertId() 
	{
		return mysqli_insert_id($this->connection);
	}
	public function numRows($result) 
	{
		return mysqli_num_rows($result);
	}
	public function insert($sql) 
	{
		if($this->connection === false) 
		{
			die('No Database Connection Found.');
		}
		$result=@mysqli_query($this->connection,$sql);
		if($result === false) 
		{
			die(mysqli_error($this->connection));
		}
	}
	public function query($sql)

	{

		if($this->connection==false)

		{

			die("No Database Connection found!!");

		}

		$result=@mysqli_query($this->connection,$sql);

		if($result === false) 

		{

			die(mysqli_error($this->connection));

		}

		return $result;

		

	}

	public function fetchArray($result)

	{

		if($this->connection==false)

		{

			die("No Database Connection found!!");

		}

		$i=0;

		$temp=array();

		while($data = @mysqli_fetch_array($result))

		{

			$temp[$i]=$data;

			$i++;

		}

		if (!is_array($temp)) 

		{

			die(mysqli_error($this->connection));

		}

		return $temp;

	}

	function selectQuery($sql) 

	{

		$this->connect();

		$results = $this->fetchArray($this->query($sql));

		$this->close();

		return $results;

	}

	function insertQuery($sql) 

	{

		$this->connect();

		$this->query($sql);

		$primary_key = $this->insertId();

		$this->close();

		return $primary_key;

	}

	function executeQuery($sql) 

	{

		$this->connect();

		$results = $this->query($sql);

		$this->close();

		return $results;

	}

	function insertRecord($tableName, $arrRecord)
    {
        $tableName = trim($tableName);
        if (empty($tableName) || empty($arrRecord) || !is_array($arrRecord))
            return FALSE;
		$this->connect();
        $fieldList = $valueList = '';
       foreach ($arrRecord as $fieldName => $fieldValue) {
            $fieldList .= $fieldName . ',';
            if (is_string($fieldValue))
                $valueList .= "'" . mysqli_real_escape_string($this->connection,$fieldValue) . "',";
            else
                $valueList .= $fieldValue . ',';
        }
        $fieldList = substr($fieldList, 0, -1);
        $valueList = substr($valueList, 0, -1);

        $insertQuery = 'INSERT INTO ' . $tableName .  ' (' . $fieldList . ') '. 'VALUE (' . $valueList . ');';
        $this->query($insertQuery);
        $primary_key = $this->insertId();
		$this->close();
		if($primary_key)
			return $primary_key;
        return FALSE;
	}

}

?>