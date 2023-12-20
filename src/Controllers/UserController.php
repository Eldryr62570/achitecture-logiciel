<?php
namespace App\Controllers;

use App\Models\Users;
use App\Core\DbConnector;
use App\Repositories\UsersRepository;

class UserController {
    public function index() {
        $dbConnector = new DbConnector();
        $usersRepository = new UsersRepository($dbConnector);
        $users = $usersRepository->getAllUsers();


        $upOne = dirname(__DIR__, 1);
        require_once($upOne . "/views/printUsers.template.php");
    }

    public function getUserById() {
        $userId = $_GET['id'];
        echo 'Afficher l\'utilisateur avec l\'ID : ' . $userId;
    }

    public function createUser() {
        $dbConnector = new DbConnector();
        $usersRepository = new UsersRepository($dbConnector);

        $users = new Users();
        $users->setFirstname($_POST['firstname']);
        $users->setLastname($_POST['lastname']);
        $users->setEmail($_POST['email']);

        $usersRepository->createUser($users);
        header('Location: /src/index.php');
    }
}