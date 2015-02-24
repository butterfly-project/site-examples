<?php

use Butterfly\Component\Form\ScalarConstraint;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

function checkValue($value) {
    return ($value * 2) < 10;
}

// Инициализация
$form = ScalarConstraint::create()
    ->addCallableValidator("checkValue", 'Некорректное значение');

// Фильтрация
$form->filter(4);

// Проверить валидность
var_dump($form->isValid()); // bool(false)
