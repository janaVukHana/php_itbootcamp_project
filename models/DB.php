<?php

class DB {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbName = 'final_project';

    public function connect() {
        // dsn = data source name
        $dsn = "mysql:host=$this->host;dbname=$this->dbName;charset=utf8";
        //pdo = php data object
        $pdo = new PDO($dsn, $this->username, $this->password);
        // napravi asocijativni niz
        // ugradjene funkcije pdo clase
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }

}
     