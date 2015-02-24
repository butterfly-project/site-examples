<?php

namespace Example_4_1;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Validation\Type;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addValidator(new Type(Type::TYPE_INT), 'Значение должно быть целым числом');

// Фильтрация
$form->filter(100);

// Проверить валидность
var_dump($form->isValid());  // bool(true)
