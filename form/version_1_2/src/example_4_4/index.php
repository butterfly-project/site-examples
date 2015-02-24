<?php

namespace Example_4_4;

use Butterfly\Component\Form\ScalarConstraint;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addCallableValidator(function ($value) {
        return ($value * 2) < 10;
    }, 'Некорректное значение');

// Фильтрация
$form->filter(4);

// Проверить валидность
var_dump($form->isValid()); // bool(false)
