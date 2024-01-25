<?php
namespace App\Controllers;

use App\Models\Users;
use App\Core\DbConnector;
use App\Repositories\UsersRepository;

class UserController {
    private $dbConnector;

    public function __construct()
    {
        $this->dbConnector = new DbConnector();
    }

    public function index() {
       
        $usersRepository = new UsersRepository($this->dbConnector);
        $users = $usersRepository->getAllUsers();
    
        $upOne = dirname(__DIR__, 1);
        require_once($upOne . "/views/printUsers.template.php");
    }

    public function getUserById() {
        $userId = $_GET['id'];
        echo 'Afficher l\'utilisateur avec l\'ID : ' . $userId;
    }

    public function createUser() {
      
        $usersRepository = new UsersRepository($this->dbConnector);

        $users = new Users([
            "id" => null,
            "firstname" => $_POST["firstname"],
            "lastname" => $_POST["lastname"],
            "email" => $_POST["email"]
        ]);
        $usersRepository->createUser($users);
        header('Location: /src/index.php');
    }
    public function changeUser(){
        $usersRepository = new UsersRepository($this->dbConnector);
        $users = new Users([
            "id" => $_POST["id"],
            "firstname" => $_POST["firstname"],
            "lastname" => $_POST["lastname"],
            "email" => $_POST["email"]
        ]);

        $usersRepository->changeUser($users);        
        header('Location: /src/index.php');
    }

}