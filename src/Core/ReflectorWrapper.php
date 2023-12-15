<?php
namespace App\Core;
use ReflectionClass;

class ReflectorWrapper {
    public function getClassCharacteristics(string $className){
        $reflectionClass = new ReflectionClass("App\\$className");
    }
}