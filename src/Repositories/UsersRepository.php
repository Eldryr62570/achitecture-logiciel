<?php
namespace App\Repositories;

use ReflectionClass;
use App\Models\Users;
use App\Core\DbConnector;
use App\Core\GenericQuery;


class UsersRepository{
    private $conn;
    private $tableName = "";
    private $dbConnector = null;
    private $genericQuery = null;

    public function __construct(DbConnector $dbConnector , GenericQuery $genericQuery = null) {
        $this->dbConnector = $dbConnector;
        $this->conn = $dbConnector->getConnection();
        $this->tableName = $this->getDefaultTableName();
        $this->genericQuery = $genericQuery ?: new GenericQuery($dbConnector);
    }
    
    private function getDefaultTableName(): string {
            $className = (new ReflectionClass($this))->getShortName();
            $className = strtolower(str_replace('Repository', '', $className));
        return $className;
    }

    public function getAllUsers(): array {
        return $this->genericQuery->getAllItems($this->tableName);
    }
    
    public function getUserById(int $id) : Users {
        return $this->genericQuery->getItemById($this->tableName , $id);
    }

   
    public function createUser(Users $user): int {
        try {
        
            $query = "INSERT INTO {$this->tableName} (firstname, lastname, email) VALUES (:firstname, :lastname, :email)";
            $statement = $this->conn->prepare($query);
    
            // Liaison des paramètres
            $statement->bindValue(':firstname', $user->getFirstname());
            $statement->bindValue(':lastname', $user->getLastname());
            $statement->bindValue(':email', $user->getEmail());
    
            // Exécution de la requête
            $statement->execute();
    
            // Retourne l'ID de l'utilisateur créé
            return $this->conn->lastInsertId();
        } catch (\PDOException $e) {
            // Log ou renvoie l'erreur au code appelant
            error_log("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return -1; // Ou une valeur d'erreur appropriée
        }
    }
    
    
    

}