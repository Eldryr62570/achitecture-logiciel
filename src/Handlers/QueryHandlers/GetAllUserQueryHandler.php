<?php
namespace App\Handlers\QueryHandlers;

use App\Models\Users;
use App\Core\BaseHandler;
use App\Core\DbConnector;
use App\Core\GenericQuery;

class GetAllUserQueryHandler extends BaseHandler {
    public function __construct(DbConnector $dbConnector , GenericQuery $genericQuery = null) {
        parent::initialize($dbConnector, $genericQuery);
        $classNameParts = explode('\\', Users::class);
        $this->tableName = strtolower(end($classNameParts));
    }

    public function handle() {
        return $this->genericQuery->getAllItems($this->tableName);
    }
}
