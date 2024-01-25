<?php

namespace App\Handlers\CommandHandlers;

use ReflectionClass;
use App\Models\Users;
use App\Core\BaseHandler;
use App\Core\DbConnector;
use App\Core\GenericQuery;


class CreateUserCommandHandler extends BaseHandler
{
    public function __construct(DbConnector $dbConnector, GenericQuery $genericQuery = null)
    {
        parent::initialize($dbConnector, $genericQuery);
        $classNameParts = explode('\\', Users::class);
        $this->tableName = strtolower(end($classNameParts));
    }

    public function handle(Users $user) {
        try {
            $reflectionClass = new ReflectionClass(Users::class);
            $properties = $reflectionClass->getProperties();
            $columnNames = array_map(function($prop) {
                return $prop->getName();
            }, $properties);

            $bindValues = array_map(function ($col) {
                return ':' . $col;
            }, $columnNames);

            $query = "INSERT INTO {$this->tableName} (" . implode(', ', $columnNames) . ") VALUES (" . implode(', ', $bindValues) . ")";
            $statement = $this->conn->prepare($query);
            
            // Liaison des paramètres
            foreach ($columnNames as $field) {
                $getterMethod = 'get' . ucfirst($field);
                $statement->bindValue(':' . $field, $user->$getterMethod());
            }
            
            // Exécution de la requête
            $statement->execute();
            
            return $this->conn->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return -1;
        }
    }
}
