<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';
require_once __DIR__ . '/CustomTransformer.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addTransformer(new CustomTransformer(12));

// Фильтрация
$form->filter(5);

// Получить значение
var_dump($form->getValue()); // int(60)
