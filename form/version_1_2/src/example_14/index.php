<?php

use Butterfly\Component\Form\ScalarConstraint;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

function transformValue($value) {
    return $value * 2;
}

// Инициализация
$form = ScalarConstraint::create()
    ->addCallableTransformer("transformValue");

// Фильтрация
$form->filter(5);

// Получить значение
var_dump($form->getValue());    // int(10)
var_dump($form->getOldValue()); // int(5)
