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

    public function getColumns($table) {
	      $dbh = $this->getDbh();

        $stmt = $dbh->prepare("DESCRIBE " . $table);

       $success = $stmt->execute();

        $data = new DbRowIterator($stmt); 
        $lastPeriod = new LastPeriodIterator($data, '2015-04-01 00:00:00'); 
        foreach ($lastPeriod as $row) { 
              echo sprintf( '%s (%s)| modified %s', $row->contact_name, $row->contact_email, $row->contact_modified ) . PHP_EOL;
        }

        if ($success !== FALSE)
        {
            $columnNames = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $columnNames;
        }

        $error = array(
            'query'     => $query,
            'errorInfo' => $this->prepareErrorInfo($dbh->errorInfo()),
        );

        $errorInfo = json_encode($error);

        throw new MysqlException($errorInfo);
    }
}