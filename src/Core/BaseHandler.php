<?php
namespace App\Core;

use App\Core\DbConnector;
use App\Core\GenericQuery;
use App\Models\Users;

class BaseHandler {
    protected $conn;
    protected $dbConnector = null;
    protected $genericQuery = null;
    protected $tableName = "";

    protected function initialize(DbConnector $dbConnector, GenericQuery $genericQuery = null) {
        $this->dbConnector = $dbConnector;
        $this->conn = $dbConnector->getConnection();
        $this->genericQuery = $genericQuery ?: new GenericQuery($dbConnector);
    }
}