<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addCallableTransformer(function ($value) {
        return $value * 2;
    });

// Фильтрация
$form->filter(5);

// Получить значение
var_dump($form->getValue());    // int(10)
var_dump($form->getOldValue()); // int(5)
