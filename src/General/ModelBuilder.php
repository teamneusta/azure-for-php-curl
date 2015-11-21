<?php

namespace TeamNeusta\WindowsAzureCurl\General;

class ModelBuilder
{
    public static function create($modelName, $arguments)
    {
        $className = 'TeamNeusta\\WindowsAzureCurl\\Model\\' . $modelName;
        if (class_exists($className) === true) {
            return new $className($arguments);
        } else {
            throw new \Exception('Service ' . $modelName . ' not found');
        }
    }
}