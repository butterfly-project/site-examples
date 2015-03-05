<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Validation\Type;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addValidator(new Type(Type::TYPE_STRING), 'Значение не должно быть строкой', true);

// Фильтрация
$form->filter('abc');

// Проверить валидность
var_dump($form->isValid()); // bool(false)
