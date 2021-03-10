<?php


class MergeRobot extends Robot
{
    protected $speed = 0;
    protected $weight = 0;

    public function __construct()
    {}

    // входящий параметр может быть или объектом Robot или массивом
    // для php 8 можно было бы использовать объединение типов
    // как сделать в 7 версии не нашел способа

    public function addRobot($robots)
    {
        if (is_array($robots)) {
            $this->weight += array_reduce($robots, function ($acc, $element) {
                $acc += $element->getWeight();
                return $acc;
            }, 0);
            usort($robots, function ($a, $b) {
                if ($a->getSpeed() == $b->getSpeed()) {
                    return 0;
                }
                return ($a->getSpeed() < $b->getSpeed()) ? -1 : 1;
            });
            $minSpeed = reset($robots)->getSpeed();
            $this->speed = $this->speed > $minSpeed ? $minSpeed : $this->speed;

        } else {
            $this->speed = $this->speed < $robots->getSpeed() ? $robots->getSpeed() : $this->speed;
            $this->weight += $robots->getWeight();
        }

        return $this;
    }
}