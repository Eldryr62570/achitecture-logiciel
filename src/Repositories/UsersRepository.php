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
        return strtolower($className);
    }

    public function getAllUsers(): array {
        return $this->genericQuery->getAllItems($this->tableName);
    }
    public function getUserById(int $id) : Users {
        return $this->genericQuery->getItemById($this->tableName , $id);
    }

    /* public function createUser(Users $users) : int {
        return $this->genericQuery->createItem($this->tableName , $users);
    } */

}