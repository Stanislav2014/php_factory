<?php

class FactoryRobot
{
    protected $types = []; // доступ только внутри класса и наследников
    protected $robots = [];

    public function addType(Robot $robot)
    {
        $this->types[get_class($robot)] = $robot;
        return $this;
    }

    protected function addRobot(string $robotClassName)
    {
        if (isset($this->types[$robotClassName])) {
            $this->robots[] = new $robotClassName;
            var_dump($this->robots);
            return $this;
        }
    }

    public function __call($method, $args)
    {
        $className = str_replace('create', '', $method);
        var_dump($className);
        var_dump($method);
        var_dump($args);
        if (is_subclass_of($className, 'Robot')) {
            if (!empty($args)) {
                $countRobots = $args[0];
                var_dump('yes');
                for ($i = 0; $i < $countRobots; $i++) {
                    self::addRobot($className);
                }
            } else {
                self::addRobot($className);
            }
            return $this->robots;
        }
//        call_user_func($method)
//        array_push($stack, "apple", "raspberry");

    }
}