<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';
require_once __DIR__ . '/CustomValidator.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addValidator(new CustomValidator(2, 1000), 'Значение не подходит под условие');

// Фильтрация
$form->filter(250);

// Проверить валидность
var_dump($form->isValid()); // bool(true)
