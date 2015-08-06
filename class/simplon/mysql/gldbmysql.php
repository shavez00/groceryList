<?php

namespace Simplon\Mysql;

class glDbMysql extends Mysql
{
    private $host = "localhost";
    private $user = "root";
    private $password = "adminadmin";
    private $database = "groceryList";
    protected $fetchMode = \PDO::FETCH_ASSOC;
    private $charset = "utf8";
    private $port = "3306";
    private $unixSocket = NULL;
	
    /**
     * @var \PDOStatement
     */
    protected $lastStatement;

    /**
     * @param $host
     * @param $user
     * @param $password
     * @param $database
     * @param int $fetchMode
     * @param string $charset
     * @param array $options
     *
     * @throws MysqlException
     */
    public function __construct(array $options = array())
    {
	      $host = $this->host;
	      $user = $this->user;
	      $password = $this->password;
	      $database = $this->database;
	      $fetchMode = $this->fetchMode;
	      $charset = $this->charset;
        try
        {
            // use host
            $dns = 'mysql:host=' . $host;

            if (isset($options['port']))
            {
                $dns .= ';port=' . $options['port'];
            }

            // use unix socket
            if (isset($options['unixSocket']))
            {
                $dns = 'mysql:unix_socket=' . $options['unixSocket'];
            }

            $dns .= ';dbname=' . $database;
            $dns .= ';charset=' . $charset;

            // ------------------------------

            // create PDO instance
            $this->setDbh(new \PDO($dns, $user, $password));

            // set fetchMode
            $this->setFetchMode($fetchMode);
        }
        catch (\PDOException $e)
        {
            throw new MysqlException($e->getMessage(), $e->getCode());
        }
    }

    protected function getTables() {
	      $dbh = $this->getDbh();
	
	      $tablesObj = $dbh->query("SHOW TABLES");
	    
	      if (!empty($tablesObj)) {
		        $tablesArray = $tablesObj->fetchAll(\PDO::FETCH_COLUMN);
	
	          $tablesObj ->closeCursor();
	
	           return $tablesArray;
		    }
	      throw new \Exception ("No tables found in database " . $this->database . "! - glDbMysql.php - line 85");
    }

    public function getColumns($table) {
	      $dbh = $this->getDbh();

        $stmt = $dbh->prepare("DESCRIBE " . $table);

       $success = $stmt->execute();

       $columnNames = $stmt->fetchAll(\PDO::FETCH_ASSOC);

       $iterator = new \RecursiveArrayIterator($columnNames); 

       $fields = array();

        if ($success !== FALSE)
        {
	           while ($iterator->valid()) {
		             if($iterator->hasChildren()) {
			                $childIterator = new \RecursiveArrayIterator($iterator->current());
			                while($childIterator->valid()) {
				                  if($childIterator->key() == "Field") array_push($fields, $childIterator->current()) ;
				                  $childIterator->next();
			                 }
			            } 
			            $iterator->next();
              }
              return $fields;
        }

        $error = array(
            'query'     => "DESCRIBE " . $table,
            'errorInfo' => $this->prepareErrorInfo($dbh->errorInfo()),
        );

        $errorInfo = json_encode($error);

        throw new MysqlException($errorInfo);
    }

    public function getRows($table, array $query)  {
	      if (!in_array($table, $this->getTables())) throw new \Exception ("The table you're trying to query does not exist - glDbMysql.php - line 127");

	      $columnNames = $this->getColumns($table);
	
	     //var_dump($columnNames);  //troubleshooting code
	
	    $diff = array_diff(array_keys($query), $columnNames);

	     if (!empty($diff)) throw new \Exception ("The column you're trying to find do not exist in the database " . $this->database . " - glDbMysql.php - line 133");
        
        echo "Success";
    }
}