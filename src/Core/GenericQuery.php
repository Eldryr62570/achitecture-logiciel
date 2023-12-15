<?php
namespace App\Core;
use PDO;
use ReflectionClass;
use App\Core\DbConnector;

class GenericQuery {
    private $conn;

    public function __construct(DbConnector $dbConnector) {
        $this->conn = $dbConnector->getConnection();
    }
    
    public function getAllItems(string $tableName): array {
        try {
            $className = 'App\Models\\' . ucfirst($tableName);
            $query = "SELECT * FROM $tableName"; 
            $statement = $this->conn->query($query);
    
            $items = [];
            $class = new ReflectionClass($className);
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $items[] = $class->newInstance($row);
            }
    
            return $items;
        } catch (\PDOException $e) {
         
            error_log("Error retrieving items: " . $e->getMessage());
            return [];
        }
    }
    
    public function getItemById(string $tableName, int $id): ?object {
        try {
            $className = 'App\Models\\' . ucfirst($tableName);
            $query = "SELECT * FROM $tableName WHERE id = :id LIMIT 1";
            $statement = $this->conn->prepare($query);
            $statement->execute([':id' => $id]);
            $class = new ReflectionClass($className);
    
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                return $class->newInstance($row);
            } else {
                return null; // Aucun enregistrement trouvé
            }
        } catch (\PDOException $e) {
            // Log the error or throw an exception
            error_log("Error retrieving item by id: " . $e->getMessage());
            return null;
        }
    }
    
}