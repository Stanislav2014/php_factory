<?php

class FactoryRobot
{
    protected $types = []; // доступ только внутри класса и наследников

    public function addType(Robot $robot)
    {
        $this->types[get_class($robot)] = $robot;
        return $this;
    }

    public function __call($method, $args)
    {
        $result = [];
        $className = str_replace('create', '', $method);
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