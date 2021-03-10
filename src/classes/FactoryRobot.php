<?php

class FactoryRobot
{
    protected $types = []; // доступ только внутри класса и наследников
    protected $methods = [];

    public function addType(Robot $robot)
    {
        $className = get_class($robot);
        $this->types[$className] = $robot;
        $this->methods["create{$className}"] = $className;
        return $this;
    }

    public function __call($method, $args)
    {
        $result = [];
        if (!isset($this->methods[$method])) {
            throw new Exception('Метод не найден');
        }
        $className = $this->methods[$method];
        if (isset($this->types[$className])) {
            if (!empty($args)) {
                $countRobots = $args[0];
                for ($i = 0; $i < $countRobots; $i++) {
                     $result[] = $this->types[$className];
                }
            } else {
                $result[] = $this->types[$className];
            }
        }
        return $result;
    }
}