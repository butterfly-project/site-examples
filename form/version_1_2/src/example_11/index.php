<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Validation\Composite;
use Butterfly\Component\Form\Validation\Type;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$typeValidator = new Composite(Composite::TYPE_OR, array(
    new Type(Type::TYPE_INT),
    new Type(Type::TYPE_STRING),
));

$form = ScalarConstraint::create()
    ->addValidator($typeValidator, 'Значение должно быть числом или строкой');

// Фильтрация
$form->filter('abc');

// Проверить валидность
var_dump($form->isValid()); // bool(true)
