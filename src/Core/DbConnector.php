<?php

namespace App\Core;

class DbConnector
{
    protected $conn;
    public function __construct()
    {
        $host = "postgres_mvc"; // Nom du conteneur postgre indiqué dans le docker-compose
        $port = "5432"; // port indiqué dans le docker compose
        $dbname = "mvc"; // nom de la db
        $username = "admin"; //username et password
        $password = "admin";
        
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password";
        
        try {
            $this->conn = new \PDO($dsn);
            if ($this->conn == null) {
                die("Erreur de connexion à la base de données.");
            }
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
         
            die("Erreur de connexion à la base de données : " . $e->getMessage());

        }
    }

    public function getConnection(){
        return $this->conn;
    }
}
