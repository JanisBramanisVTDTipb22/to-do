<?php
require "../config.php";

class Database {
    private $host;
    private $user;
    private $pass;
    private $dbname;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct(){
        // Fetch database configuration
        $config = require "../config.php";
        
        // Set database connection parameters
        $this->host = $config['host'];
        $this->user = $config['user'];
        $this->pass = $config['password'];
        $this->dbname = $config['dbname'];

        // Set options for PDO
        $options = [
            PDO::ATTR_PERSISTENT => true, // Set persistent connection
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Set error mode
        ];

        // Create PDO instance
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname}";
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null){
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        return $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function rowCount(){
        return $this->stmt->rowCount();
    }

    public function lastId(){
        return $this->dbh->lastInsertId();
    }
}

function fetchTasksFromDatabase($config) {
    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}", $config['user'], $config['password']);
        
        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Prepare and execute the SQL query to fetch tasks
        $stmt = $pdo->query("SELECT * FROM tasks");
        
        // Fetch tasks as an associative array
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $tasks;
    } catch (PDOException $e) {
        // Handle database connection error
        echo "Error fetching tasks: " . $e->getMessage();
        return false;
    }
}