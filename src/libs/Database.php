<?php
/**
 * PDO Database Class
 * Connect to the database
 * Create prepared statements
 * Bind Values
 * Return rows and results
 */
class Database
{
    private $host   = CONFIG['host'];
    private $user   = CONFIG['username'];
    private $pass   = CONFIG['password'];
    private $dbname = CONFIG['dbname'];
    
    private $dbh; // Database Handler
    private $stmt; // Statemnt
    private $error; // Error

    public function __construct()
    {
        // Set Data Source Name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create PDO Instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($param, $value, $type = null)
    {
        if(is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type =  PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type =  PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type =  PDO::PARAM_NULL;
                    break;            
                default:
                    $type =  PDO::PARAM_INT;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Get result set as array of objects
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get result of a single row
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get Row Count
    public function rowCount()
    {
        return $this->stmt-rowCount();
    }
}
?>