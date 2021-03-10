<?php

// сделал этот класс чтобы можно было прописать
// тип входящего параметра в FactoryRobot для метода __call и для удобства расширения

class Robot
{
    protected $speed;
    protected $weight;

    public function getSpeed()
    {
        return $this->speed;
    }
    public function getWeight()
    {
        return $this->weight;
    }

}