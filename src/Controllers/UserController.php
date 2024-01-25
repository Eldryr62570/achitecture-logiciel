<?php
namespace App\Controllers;

use App\Core\DbConnector;
use App\Handlers\CommandHandlers\CreateUserCommandHandler;
use App\Handlers\QueryHandlers\GetAllUserQueryHandler;
use App\Models\Users;

class UserController {
    private DbConnector $dbConnector;

    public function __construct() {
        $this->dbConnector = new DbConnector();
    }

    public function index() {
        $getAllUsersHandler = new GetAllUserQueryHandler($this->dbConnector);        
        $users = $getAllUsersHandler->handle();

        $insertUserHandler = new CreateUserCommandHandler($this->dbConnector);
        $userToInsert = new Users([
            "id" => null,
            "firstname" => "ho",
            "lastname" => "ha",
            "email" => "ko"
        ]);

        $insertUserHandler->handle($userToInsert);

        include 'views/printUsers.template.php';
    }

    // public function createUser() {
    //     $handler = new CreateUserCommandHandler($this->dbConnector);
    //     $result = $handler->handle();
    //     // Reste du code...
    // }

    // Autres méthodes...
}
