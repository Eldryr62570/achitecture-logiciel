<?php
namespace App\Models;

class Users {
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $email;

    public function __construct(array $userArray)
    {
        $this->id = $userArray["id"];
        $this->firstname = $userArray["firstname"];
        $this->lastname = $userArray["lastname"];
        $this->email = $userArray["email"];
    }

    public function getId(){
        return $this->id;
    }

    public function getFirstname(){
        return $this->firstname;
    }

    public function getLastname(){
        return $this->lastname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function setFirstname(string $firstname){
        $this->firstname = $firstname;
    }

    public function setLastname(string $lastname){
        $this->lastname = $lastname;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }
}