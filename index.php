<?php

// Добавил автозагрузчик для удобства подключения новых классов

require_once(__DIR__ . '/src/autoload.php');

$factory = new FactoryRobot();

$factory->addType(new Robot1());
$factory->addType(new Robot2());

var_dump($factory->createRobot1(5));
var_dump($factory->createRobot2(2));

$mergeRobot = new MergeRobot();
$mergeRobot->addRobot(new Robot2());
$mergeRobot->addRobot($factory->createRobot2(2));
$factory->addType($mergeRobot);
$res = reset($factory->createMergeRobot(1));

echo $res->getSpeed();

echo $res->getWeight();
