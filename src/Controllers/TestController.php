<?php
namespace App\Controllers;

use App\Core\DbConnector;
use App\Repositories\UsersRepository;

class TestController {
    public function index() {

        $maRequete = ["azneianz" => ["yeaze"]];


        $upOne = dirname(__DIR__, 1);
        require_once($upOne . "/views/printTest.template.php");
    }
}